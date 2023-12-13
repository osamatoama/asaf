<?php

namespace App\Services;

use App\Models\AuditLog;
use Yajra\DataTables\Facades\DataTables;

class AuditLogService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.audit-log.route_view') ?? '';
        $this->permissions = config('models.audit-log.permissions') ?? [];
        $this->routeName   = config('models.audit-log.route_name') ?? '';
    }

    public function getAuditLogs($filter = [])
    {
        $auditLogs = AuditLog::query();

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($auditLogs);
        }

        $auditLogs = $auditLogs->latest('id');
        $params = [];

        if ($filter['q'] ?? false) {
            $auditLogs = $auditLogs->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('subject_id', $filter['q'])
                    ->orWhere('user_id', $filter['q'])
                    ->orWhere('description', 'like', '%' . $filter['q'] . '%')
                    ->orWhere('subject_type', 'like', '%' . $filter['q'] . '%');
            });
            $params['q'] = $filter['q'];
        }

        if ($filter['paginate'] ?? false) {
            $auditLogs = $auditLogs->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $auditLogs = $auditLogs->appends($params);
            }
            return $auditLogs;
        }

        return $auditLogs->get();
    }

    private function prepareDatatable($query)
    {
        $table = Datatables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
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

        $table->editColumn('id', function ($row) {
            return $row->id ?? '';
        });
        $table->editColumn('description', function ($row) {
            return $row->description ?? '';
        });
        $table->editColumn('subject_id', function ($row) {
            return $row->subject_id ?? '';
        });
        $table->editColumn('subject_type', function ($row) {
            return $row->subject_type ?? '';
        });
        $table->editColumn('user_id', function ($row) {
            return $row->user_id ?? '';
        });
        $table->editColumn('host', function ($row) {
            return $row->host ?? '';
        });

        $table->rawColumns(['actions', 'placeholder']);

        return $table->make();
    }
}
