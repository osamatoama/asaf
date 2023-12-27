<?php

namespace App\Services;

use App\Models\Client;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Support\Collection as CollectionAlias;
use Yajra\DataTables\Facades\DataTables;

class ClientService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.client.route_view') ?? '';
        $this->permissions = config('models.client.permissions') ?? [];
        $this->routeName   = config('models.client.route_name') ?? '';
    }

    /**
     * @throws Exception
     */
    public function getClients($filter = []): Client|LengthAwarePaginator|Builder|Collection|LengthAwarePaginatorAlias|CollectionAlias|JsonResponse
    {
        $clients = Client::withCount('results');

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($clients);
        }

        if (($filter['asc'] ?? false)) {
            $clients = $clients->oldest('id');
        } else {
            $clients = $clients->latest('id');
        }
        $params = [];

        if ($filter['q'] ?? false) {
            $clients = $clients->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('key', 'like', '%' . $filter['q'] . '%')
                    ->orWhere('phone', 'like', '%' . $filter['q'] . '%')
                    ->orWhere('email', 'like', '%' . $filter['q'] . '%');
            });
            $params['q'] = $filter['q'];
        }

        if ($filter['paginate'] ?? false) {
            $clients = $clients->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $clients = $clients->appends($params);
            }
            return $clients;
        }

        return $clients->get();
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

        $table->editColumn('id', function (Client $row) {
            return $row->id ?? '---';
        });
        $table->editColumn('key', function (Client $row) {
            return $row->key ?? '---';
        });
        $table->editColumn('phone', function (Client $row) {
            return $row->phone ?? '---';
        });
        $table->editColumn('email', function (Client $row) {
            return $row->email ?? '---';
        });

        $table->editColumn('results_count', function (Client $row) {
            return $row->results_count ?? 0;
        });

        $table->rawColumns(['actions', 'placeholder']);

        return $table->make();
    }
}
