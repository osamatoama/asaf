<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\StoreRequest;
use App\Http\Requests\Dashboard\Product\UpdateRequest;
use App\Models\Product;
use App\Services\GenderService;
use App\Services\ProductService;
use Exception;
use Gate;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizController extends Controller
{
    private string $routeView;
    private string $routeName;
    private array $permissions;
    private ProductService $productService;
    private GenderService $genderService;


    public function __construct(ProductService $productService, GenderService $genderService)
    {
        $this->routeView      = config('models.product.route_view') ?? '';
        $this->routeName      = config('models.product.route_name') ?? '';
        $this->permissions    = config('models.product.permissions') ?? [];
        $this->productService = $productService;
        $this->genderService  = $genderService;
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): View|Application|Factory|ApplicationAlias|Response
    {
        abort_if(Gate::denies($this->permissions['access']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if ($request->ajax() || $request->expectsJson()) {
            return $this->productService
                ->getProducts(['requestType' => 'datatable']);
        }

        $products = $this->productService
            ->getProducts([
                'q'        => $request->q ?? null,
                'paginate' => (int)($request->paginate ?? GlobalConstants::PAGINATION_DEFAULT_COUNT),
                'page'     => (int)($request->page ?? 1),
            ]);

        return view('dashboard.pages.' . $this->routeView . '.index', compact('products'));
    }

    public function create(): View|Application|Factory|ApplicationAlias
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $genders = $this->genderService->getPluckGenders(['asc' => true])
            ->prepend(trans('global.pleaseSelect'), '');

        return view('dashboard.pages.' . $this->routeView . '.create', compact('genders'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $store = $this->productService->store($request);

        if ($store->success) {
            return redirect()
                ->route('dashboard.' . $this->routeName . '.index')
                ->with('success_message', $store->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $store->message);
    }

    public function edit(Product $product): View|Application|Factory|ApplicationAlias
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $genders = $this->genderService->getPluckGenders(['asc' => true])
            ->prepend(trans('global.pleaseSelect'), '');

        return view('dashboard.pages.' . $this->routeView . '.edit', compact('product', 'genders'));
    }

    public function update(UpdateRequest $request, Product $product): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $update = $this->productService->update($request, $product);

        if ($update->success) {
            return redirect()
                ->route('dashboard.' . $this->routeName . '.index')
                ->with('success_message', $update->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $update->message);
    }

    public function show(Product $product): View|Application|Factory|ApplicationAlias
    {
        abort_if(Gate::denies($this->permissions['show']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $product->load('gender');

        return view('dashboard.pages.' . $this->routeView . '.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies($this->permissions['delete']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if (request()?->ajax() || request()?->expectsJson()) {
            return response()->json($this->productService->destroy($product));
        }

        abort(Response::HTTP_NOT_FOUND, '404 Not Found');
    }
}
