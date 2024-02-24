<?php

namespace App\Http\Controllers\Dashboard\Reports;

use App\Services\ReportService;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class QuizCompletionReportCompletion extends Controller
{
    private string $routeView;

    private array $permissions;

    public function __construct(private ReportService $reportService)
    {
        $this->routeView      = 'reports.quiz-completion';
        $this->permissions    = [
            'access' => 'report_access',
        ];
    }

    public function index()
    {
        abort_if(Gate::denies($this->permissions['access']), 403, 'ليس لديك صلاحية');
        $result = $this->reportService->getQuizCompletionReport();

        return view('dashboard.pages.' . $this->routeView . '.index', compact('result'));
    }
}
