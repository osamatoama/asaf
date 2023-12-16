<?php

namespace App\Services;

use App\Models\Gender;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as CollectionAlias;
use Yajra\DataTables\Facades\DataTables;

class GenderService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.gender.route_view') ?? '';
        $this->permissions = config('models.gender.permissions') ?? [];
        $this->routeName   = config('models.gender.route_name') ?? '';
    }

    /**
     * @throws Exception
     */
    public function getGenders($filter = []): Gender|LengthAwarePaginator|Builder|Collection|LengthAwarePaginatorAlias|CollectionAlias|JsonResponse
    {
        $genders = Gender::withCount('products');

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($genders);
        }

        if (($filter['asc'] ?? false)) {
            $genders = $genders->oldest('id');
        } else {
            $genders = $genders->latest('id');
        }
        $params = [];

        if ($filter['q'] ?? false) {
            $genders = $genders->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('name', 'like', '%' . $filter['q'] . '%');
            });
            $params['q'] = $filter['q'];
        }

        if ($filter['pluck'] ?? false) {
            return $genders->pluck('name', 'id');
        }

        if ($filter['paginate'] ?? false) {
            $genders = $genders->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $genders = $genders->appends($params);
            }
            return $genders;
        }

        return $genders->get();
    }

    /**
     * @throws Exception
     */
    public function getPluckGenders(array $filter = []): Collection|LengthAwarePaginator|Builder|LengthAwarePaginatorAlias|JsonResponse|CollectionAlias|Gender
    {
        $filter = Arr::except($filter, 'requestType');
        $filter['pluck'] = true;

        return $this->getGenders($filter);
    }

    /**
     * @throws Exception
     */
    private function prepareDatatable($query): JsonResponse
    {
        $table = Datatables::of($query);

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

        $table->editColumn('id', function (Gender $row) {
            return $row->id ?? '---';
        });
        $table->editColumn('name', function (Gender $row) {
            return $row->name ?? '---';
        });
        $table->editColumn('products_count', function (Gender $row) {
            return $row->products_count ?? 0;
        });

        $table->rawColumns(['actions', 'placeholder']);

        return $table->make();
    }
}
