<?php

namespace App\Services;

use App\Http\Requests\Dashboard\Role\StoreRequest;
use App\Http\Requests\Dashboard\Role\UpdateRequest;
use App\Models\Role;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginator_2;
use Illuminate\Support\Collection as Support_Collection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoleService
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
     * RoleService constructor.
     */
    public function __construct()
    {
        $this->routeView   = config('models.role.route_view') ?? '';
        $this->permissions = config('models.role.permissions') ?? [];
        $this->routeName   = config('models.role.route_name') ?? '';
    }

    /**
     * @param int|null $authId
     * @param array $filter
     * @return Role|LengthAwarePaginator|Builder|Collection|LengthAwarePaginator_2|Support_Collection|JsonResponse
     * @throws Exception
     */
    public function getRoles(?int $authId, array $filter = []): Role|LengthAwarePaginator|Builder|Collection|LengthAwarePaginator_2|Support_Collection|JsonResponse
    {
        $roles = Role::select(['id', 'title'])
            ->with('permissions')
            ->where('related_user_id', $authId);

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($roles);
        }

        if (($filter['asc'] ?? false)) {
            $roles = $roles->oldest('id');
        } else {
            $roles = $roles->latest('id');
        }
        $params = [];

        if ($filter['q'] ?? false) {
            $roles = $roles->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('title', 'like', '%' . $filter['q'] . '%')
                    ->orWhere('slug', 'like', '%' . $filter['q'] . '%')
                    ->orWhereHas('permissions', function ($q) use ($filter) {
                        $q->where('title', 'like', '%' . $filter['q'] . '%');
                    });
            });
            $params['q'] = $filter['q'];
        }


        if ($filter['paginate'] ?? false) {
            $roles = $roles->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $roles = $roles->appends($params);
            }
            return $roles;
        }

        return $roles->get();
    }

    /**
     * @param StoreRequest $request
     * @return object
     */
    public function store(StoreRequest $request): object
    {
        DB::beginTransaction();
        try {
            $role = Role::create($request->validated());
            $role->permissions()->sync($request->permissions());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم إضافة الإذن بنجاح',
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
     * @param Role $role
     * @return object
     */
    public function update(UpdateRequest $request, Role $role): object
    {
        DB::beginTransaction();
        try {
            $role->update($request->validated());
            $role->permissions()->sync($request->permissions());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل الإذن بنجاح',
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
     * @param Role $role
     * @return object
     */
    public function destroy(Role $role): object
    {
        DB::beginTransaction();
        try {
            $role->delete();

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم حذف الإذن بنجاح',
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

        $table->editColumn('actions', function (Role $row) {
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

        $table->editColumn('id', function (Role $row) {
            return $row->id ?? '';
        });
        $table->editColumn('title', function (Role $row) {
            return $row->title ?? '---';
        });

        $table->addColumn('permissions', function (Role $row) {
            return view('dashboard.pages.' . $this->routeView . '.partials.cols.permissions',
                compact('row'));
        });

        $table->filterColumn('permissions', function ($query, $keyword) {
            $query->whereHas('permissions', function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            });
        });

        $table->rawColumns(['actions', 'placeholder', 'permissions']);

        return $table->make();
    }
}
