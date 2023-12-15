<?php

namespace App\Services;

use App\Http\Requests\Dashboard\Product\StoreRequest;
use App\Http\Requests\Dashboard\Product\UpdateRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.product.route_view') ?? '';
        $this->permissions = config('models.product.permissions') ?? [];
        $this->routeName   = config('models.product.route_name') ?? '';
    }

    /**
     * @throws Exception
     */
    public function getProducts(array $filter = [])
    {
        $products = Product::query();

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($products);
        }

        if (($filter['asc'] ?? false)) {
            $products = $products->oldest('id');
        } else {
            $products = $products->latest('id');
        }
        $params = [];

        if ($filter['q'] ?? false) {
            $products = $products->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('name', 'like', '%' . $filter['q'] . '%')
                    ->orWhereHas('gender', function ($q) use ($filter) {
                        $q->where('name', 'like', '%' . $filter['q'] . '%');
                    });
            });
            $params['q'] = $filter['q'];
        }

        if ($filter['pluck'] ?? false) {
            return $products->pluck('name', 'id');
        }

        if ($filter['paginate'] ?? false) {
            $products = $products->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $products = $products->appends($params);
            }
            return $products;
        }

        return $products->get();
    }

    /**
     * @throws Exception
     */
    public function getPluckProducts(array $filter = []): JsonResponse
    {
        $filter = Arr::except($filter, 'requestType');
        $filter['pluck'] = true;

        return $this->getProducts($filter);
    }

    public function store(StoreRequest $request): object
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated());
            if ($request->input('image', false)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))
                    ->toMediaCollection('product-images');
            }

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم إضافة المنتج بنجاح',
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object) [
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }

    public function update(UpdateRequest $request, Product $product): object
    {
        DB::beginTransaction();
        try {
            $product->update($request->validated());
            $image = $product->image->media ?? false;
            if (($request->input('image', false))
                && ((!$image) || ($request->input('image') !== $image->file_name))) {

                $product->clearMediaCollection('product-images');
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))
                    ->toMediaCollection('product-images');
            }

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل المنتج بنجاح',
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object)[
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }

    public function destroy(Product $product): object
    {
        DB::beginTransaction();
        try {
            $product->delete();

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم حذف المنتج بنجاح',
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object)[
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }

    /**
     * @throws Exception
     */
    private function prepareDatatable($query): JsonResponse
    {
        $table = DataTables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
            $viewGate      = $this->permissions['show'];
            $editGate      = $this->permissions['edit'];
            $deleteGate    = $this->permissions['delete'];
            $crudRoutePart = $this->routeName;


            return view('dashboard.pages.' . $this->routeView . '.partials.cols.actions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
        });

        $table->editColumn('id', function (Product $row) {
            return $row->id ?? '';
        });
        $table->addColumn('image', function (Product $row) {
            if ($row->image->media ?? false) {
                return sprintf(
                    '<img src="%s" class="pointer"
                                style="border-radius: 10px; width: 50px; height: 50px;"
                                data-src="%s" data-fancybox
                                alt="%s">',
                    $row->image->thumbnail,
                    $row->image->default,
                    $row->title
                );
            }

            if (filled($row->image_url)) {
                return sprintf(
                    '<img src="%s" class="pointer"
                                style="border-radius: 10px; width: 50px; height: 50px;"
                                data-src="%s" data-fancybox
                                alt="%s">',
                    $row->image_url,
                    $row->image_url,
                    $row->title
                );
            }

            return '';
        });
        $table->addColumn('product_name', function (Product $row) {
            return sprintf(
                '<a href="%s" target="_blank">%s</a>',
                $row->url,
                ($row->name ?? '---')
            );
        });
        $table->filterColumn('product_name', function ($q, $keyword) {
            $q->where('name', 'LIKE', "%$keyword%");
        });

        $table->addColumn('gender_name', function (Product $row) {
            return $row->gender->name ?? '---';
        });

        $table->filterColumn('gender_name', function ($q, $keyword) {
            $q->whereHas('gender', function ($q1) use ($keyword) {
                $q1->where('name', 'LIKE', "%$keyword%");
            });
        });

        $table->rawColumns(['actions', 'placeholder', 'image', 'product_name', 'gender_name']);

        return $table->make();
    }
}
