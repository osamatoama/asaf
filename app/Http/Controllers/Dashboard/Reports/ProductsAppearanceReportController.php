<?php

namespace App\Http\Controllers\Dashboard\Reports;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Support\Facades\Gate;

class ProductsAppearanceReportController extends Controller
{
    private string $routeView;

    private array $permissions;

    public function __construct(private ReportService $reportService)
    {
        $this->routeView      = 'reports.products-appearance';
        $this->permissions    = [
            'access' => 'report_access',
        ];
    }

    public function index()
    {
        abort_if(Gate::denies($this->permissions['access']), 403, 'ليس لديك صلاحية');
        $result = $this->reportService->getProductsAppearanceReport();

        return view('dashboard.pages.' . $this->routeView . '.index', compact('result'));
    }
}
