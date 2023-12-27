<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\StoreRequest;
use App\Http\Requests\Dashboard\Role\UpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Exception;
use Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{

    /**
     * @var string
     */
    private string $routeView;

    /**
     * @var string
     */
    private string $routeName;

    /**
     * @var array
     */
    private array $permissions;

    /**
     * @var RoleService
     */
    private RoleService $roleService;

    /**
     * RoleController constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->routeView   = config('models.role.route_view') ?? '';
        $this->routeName   = config('models.role.route_name') ?? '';
        $this->permissions = config('models.role.permissions') ?? [];
        $this->roleService = $roleService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|JsonResponse|LengthAwarePaginator
     * @throws Exception
     */
    public function index(Request $request): View|Factory|Application|JsonResponse|LengthAwarePaginator
    {
        abort_if(Gate::denies($this->permissions['access']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if ($request->ajax() || $request->expectsJson()) {
            return $this->roleService
                ->getRoles(authId(), ['requestType' => 'datatable']);
        }

        $roles = $this->roleService
            ->getRoles(authId(), [
                'q'        => $request->q ?? null,
                'paginate' => (int)($request->paginate ?? GlobalConstants::PAGINATION_DEFAULT_COUNT),
                'page'     => (int)($request->page ?? 1),
            ]);

        return view('dashboard.pages.' . $this->routeView . '.index', compact('roles'));
    }

    /**
     * @return Factory|Application|ViewAlias
     */
    public function create()
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $permissions = $this->getPermissions();

        return view('dashboard.pages.' . $this->routeView . '.create', compact('permissions'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $store = $this->roleService->store($request);

        if ($store->success) {
            return redirect()
                ->route('dashboard.' . $this->routeName . '.index')
                ->with('success_message', $store->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $store->message);
    }

    /**
     * @param Role $role
     * @return Factory|Application|ViewAlias
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies($this->permissions['edit']) || Role::isMainRole($role), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $rolePermissions = $role->permissions()->pluck('permissions.id')->toArray();
        $permissions     = $this->getPermissions();

        return view('dashboard.pages.' . $this->routeView . '.edit',
            compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * @param UpdateRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Role $role): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $update = $this->roleService->update($request, $role);

        if ($update->success) {
            return redirect()
                ->route('dashboard.' . $this->routeName . '.index')
                ->with('success_message', $update->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $update->message);
    }

    /**
     * @param Role $role
     * @return Factory|Application|ViewAlias
     */
    public function show(Role $role)
    {
        abort_if(Gate::denies($this->permissions['show']) || Role::isMainRole($role), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $role->load('permissions');

        return view('dashboard.pages.' . $this->routeView . '.show', compact('role'));
    }

    /**
     * @param Role $role
     * @return JsonResponse|null
     */
    public function destroy(Role $role): ?JsonResponse
    {
        abort_if(Gate::denies($this->permissions['delete'])
            || !in_array($role->related_user_id, [
                (authId() ?? 0),
                (authUser()->parent_id ?? 0),
            ]), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if (request()?->ajax() || request()?->expectsJson()) {
            return response()->json($this->roleService->destroy($role));
        }

        abort(Response::HTTP_NOT_FOUND, '404 Not Found');
    }

    /**
     * @return Collection
     */
    protected function getPermissions(): Collection
    {
        return Permission::allowedPermissions()
            ->withoutContentPermissions()
            ->get(['id', 'title']);
    }
}
