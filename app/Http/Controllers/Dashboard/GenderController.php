<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Services\GenderService;
use App\Services\ProductService;
use Exception;
use Gate;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenderController extends Controller
{
    private string $routeView;

    private array $permissions;

    private GenderService $genderService;

    public function __construct(GenderService $genderService)
    {
        $this->routeView      = config('models.gender.route_view') ?? '';
        $this->permissions    = config('models.gender.permissions') ?? [];
        $this->genderService  = $genderService;
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): View|Application|Factory|ApplicationAlias|Response
    {
        abort_if(Gate::denies($this->permissions['access']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if ($request->ajax() || $request->expectsJson()) {
            return $this->genderService
                ->getGenders(['requestType' => 'datatable']);
        }

        $genders = $this->genderService
            ->getGenders([
                'q'        => $request->q ?? null,
                'paginate' => (int)($request->paginate ?? GlobalConstants::PAGINATION_DEFAULT_COUNT),
                'page'     => (int)($request->page ?? 1),
            ]);

        return view('dashboard.pages.' . $this->routeView . '.index', compact('genders'));
    }

    /**
     * @throws Exception
     */
    public function show(Gender $gender): View|Factory|Application|ApplicationAlias|Response
    {
        abort_if(Gate::denies($this->permissions['show']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $gender->loadCount('products');

        $products = (new ProductService())->getPluckProducts(['asc' => true, 'gender_id' => $gender->id]);

        return view('dashboard.pages.' . $this->routeView . '.show', compact('gender', 'products'));
    }
}
