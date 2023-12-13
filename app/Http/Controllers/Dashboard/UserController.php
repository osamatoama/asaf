<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
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
     * @var UserService
     */
    private UserService $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->routeView   = config('models.user.route_view') ?? '';
        $this->routeName   = config('models.user.route_name') ?? '';
        $this->permissions = config('models.user.permissions') ?? [];
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies($this->permissions['access']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax() || $request->expectsJson()) {
            return $this->userService
                ->getUsers(authId(), ['requestType' => 'datatable']);
        }

        $users = $this->userService
            ->getUsers(authId(), [
                'q'        => $request->q ?? null,
                'paginate' => (int)($request->paginate ?? GlobalConstants::PAGINATION_DEFAULT_COUNT),
                'page'     => (int)($request->page ?? 1),
            ]);

        return view('dashboard.pages.' . $this->routeView . '.index', compact('users'));
    }

    /**
     * @return Factory|Application|ViewAlias
     */
    public function create()
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = $this->getRoles();

        return view('dashboard.pages.' . $this->routeView . '.create', compact('roles'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $store = $this->userService->store($request);

        if ($store->success) {
            return redirect()
                ->route('dashboard.' . $this -> routeName . '.index')
                ->with('success_message', $store->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $store->message);
    }

    /**
     * @param User $user
     * @return Factory|Application|ViewAlias
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies($this->permissions['edit'])
            || (authId() === $user->id)
            || (authId() !== $user->parent_id), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');
        $roles       = $this->getRoles();
        $currentRole = $user->roles->first()->id ?? 0;

        return view('dashboard.pages.' . $this->routeView . '.edit', compact('user', 'roles', 'currentRole'));
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $update = $this->userService->update($request, $user);

        if ($update->success) {
            return redirect()
                ->route('dashboard.' . $this -> routeName . '.index')
                ->with('success_message', $update->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $update->message);
    }

    /**
     * @param User $user
     * @return Factory|Application|ViewAlias
     */
    public function show(User $user)
    {
        abort_if(Gate::denies($this->permissions['show'])
            || (authId() === $user->id)
            || (authId() !== $user->parent_id), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('dashboard.pages.' . $this->routeView . '.show', compact('user'));
    }

    /**
     * @param User $user
     * @return JsonResponse|null
     */
    public function destroy(User $user): ?JsonResponse
    {
        abort_if(Gate::denies($this->permissions['delete']) || (authId() === $user->id), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(request()?->ajax() || request()?->expectsJson()) {
            return response()->json($this->userService->destroy($user));
        }

        abort(Response::HTTP_NOT_FOUND, '404 Not Found');
    }

    /**
     * @param User $user
     * @param string $type
     * @return JsonResponse|null
     */
    public function toggle(User $user, string $type): ?JsonResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_unless(in_array($type, ['verified', 'active']), Response::HTTP_NOT_FOUND, '404 Not Found');

        if(request()?->ajax() || request()?->expectsJson()) {
            return response()->json($this->userService->toggle($user, $type));
        }

        abort(Response::HTTP_NOT_FOUND, '404 Not Found');
    }

    /**
     * @return Collection
     */
    protected function getRoles(): Collection
    {
        $roles = Role::where('related_user_id', authId())->get(['id', 'title']);

        return $roles ?? collect();
    }
}
