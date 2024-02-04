<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    private string $routeView;

    private array $permissions;

    public function __construct()
    {
        $this->routeView      = 'reports';
        $this->permissions    = [
            'access' => 'report_access',
        ];
    }

    public function index()
    {
        abort_if(Gate::denies($this->permissions['access']), 403, 'ليس لديك صلاحية');

        return view('dashboard.pages.' . $this->routeView . '.index');
    }
}
