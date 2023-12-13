<?php

namespace App\Services;

use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Support\Collection as CollectionAlias;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    /**
     * @var string
     */
    private string $routeView;

    /**
     * @var array
     */
    private array $permissions;

    /**
     * @var string
     */
    private string $routeName;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->routeView   = config('models.user.route_view') ?? '';
        $this->permissions = config('models.user.permissions') ?? [];
        $this->routeName   = config('models.user.route_name') ?? '';
    }

    /**
     * @param int|null $authId
     * @param array $filter
     * @return User|LengthAwarePaginator|Builder|Collection|LengthAwarePaginatorAlias|CollectionAlias|JsonResponse
     * @throws Exception
     */
    public function getUsers(?int $authId, array $filter = []): User|LengthAwarePaginator|Builder|Collection|LengthAwarePaginatorAlias|CollectionAlias|JsonResponse
    {
        $users = User::with(['roles'])
            ->where('parent_id', $authId);

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($users);
        }

        if (($filter['asc'] ?? false)) {
            $users = $users->oldest('id');
        } else {
            $users = $users->latest('id');
        }
        $params = [];

        if ($filter['q'] ?? false) {
            $users = $users->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('name', 'like', '%' . $filter['q'] . '%')
                    ->orWhere('email', 'like', '%' . $filter['q'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['q'] . '%');
            });
            $params['q'] = $filter['q'];
        }


        if ($filter['paginate'] ?? false) {
            $users = $users->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $users = $users->appends($params);
            }
            return $users;
        }

        return $users->get();
    }

    /**
     * @param StoreRequest $request
     * @return object
     */
    public function store(StoreRequest $request): object
    {
        if (User::where('phone', $request->validated()['phone'])->exists()) {
            throw ValidationException::withMessages([
                'phone' => __('validation/admin.phone_unique'),
            ]);
        }

        DB::beginTransaction();
        try {
            $user = User::create($request->validated());
            $user->roles()->sync($request->roleId());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم إضافة المستخدم بنجاح',
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
     * @param UpdateRequest $request
     * @param User $user
     * @return object
     */
    public function update(UpdateRequest $request, User $user): object
    {
        if (User::whereKeyNot($user)->where('phone', $request->validated()['phone'])->exists()) {
            throw ValidationException::withMessages([
                'phone' => __('validation/admin.phone_unique'),
            ]);
        }

        DB::beginTransaction();
        try {
            $user->update($request->validated());

            $user->roles()->sync($request->roleId());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل المستخدم بنجاح',
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
     * @param User $user
     * @return object
     */
    public function destroy(User $user): object
    {
        DB::beginTransaction();
        try {

            $user->delete();

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم حذف المستخدم بنجاح',
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
     * @param User $user
     * @param string $type
     * @return object
     */
    public function toggle(User $user, string $type): object
    {
        DB::beginTransaction();
        try {

            $user->update([
                $type => !$user->{$type},
            ]);

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل حالة المستخدم بنجاح',
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
     * @param $query
     * @return JsonResponse
     * @throws Exception
     */
    private function prepareDatatable($query): JsonResponse
    {
        $table = Datatables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function (User $row) {
            $viewGate = $this->permissions['show'];
            $editGate = $this->permissions['edit'];
            $deleteGate = $this->permissions['delete'];
            $crudRoutePart = $this->routeName;

            return view('dashboard.pages.' . $this->routeView . '.partials.cols.actions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
        });

        $table->editColumn('id', function (User $row) {
            return $row->id ?? '';
        });

        $table->editColumn('name', function (User $row) {
            return $row->name ?? '---';
        });

        $table->editColumn('phone', function (User $row) {
            return $row->phone ?? '---';
        });

        $table->editColumn('email', function (User $row) {
            return $row->email ?? '---';
        });

        $table->editColumn('verification_code', function (User $row) {
            return $row->verification_code ?? '---';
        });

        $table->editColumn('verified', function (User $row) {
            return view('dashboard.pages.' . $this->routeView . '.partials.cols.verified',
                compact('row'));
        });

        $table->editColumn('active', function (User $row) {
            return view('dashboard.pages.' . $this->routeView . '.partials.cols.active',
                compact('row'));
        });

        $table->addColumn('roles', function (User $row) {
            return view('dashboard.pages.' . $this->routeView . '.partials.cols.roles',
                compact('row'));
        });

        $table->filterColumn('roles', function ($query, $keyword) {
            $query->whereHas('roles', function ($role) use ($keyword) {
                $role->where('title', 'like', "%$keyword%")
                    ->orWhere('slug', 'like', "%$keyword%");
            });
        });

        $table->rawColumns(['actions', 'placeholder', 'roles']);

        return $table->make();
    }
}
