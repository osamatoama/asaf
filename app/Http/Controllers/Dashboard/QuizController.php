<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Quiz\UpdateRequest;
use App\Models\Quiz;
use App\Services\ProductService;
use App\Services\QuizService;
use Exception;
use Gate;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizController extends Controller
{
    private string $routeView;
    private string $routeName;
    private array $permissions;
    private QuizService $quizService;


    public function __construct(QuizService $quizService)
    {
        $this->routeView      = config('models.quiz.route_view') ?? '';
        $this->routeName      = config('models.quiz.route_name') ?? '';
        $this->permissions    = config('models.quiz.permissions') ?? [];
        $this->quizService    = $quizService;
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): View|Application|Factory|ApplicationAlias|Response
    {
        abort_if(Gate::denies($this->permissions['access']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if ($request->ajax() || $request->expectsJson()) {
            return $this->quizService
                ->getQuizzes(['requestType' => 'datatable']);
        }

        $quizzes = $this->quizService
            ->getQuizzes([
                'q'        => $request->q ?? null,
                'paginate' => (int)($request->paginate ?? GlobalConstants::PAGINATION_DEFAULT_COUNT),
                'page'     => (int)($request->page ?? 1),
            ]);

        return view('dashboard.pages.' . $this->routeView . '.index', compact('quizzes'));
    }

    public function edit(Quiz $quiz): View|Application|Factory|ApplicationAlias
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $quiz->load('questions.answers')->loadCount('results');

        $productOptions = (new ProductService)->getProductsForSelectOptions();

        return view('dashboard.pages.' . $this->routeView . '.edit', compact('quiz', 'productOptions'));
    }

    public function update(UpdateRequest $request, Quiz $quiz): RedirectResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        abort(403, 'Coming Soon...');

        $update = $this->quizService->update($request, $quiz);

        if ($update->success) {
            return redirect()
                ->route('dashboard.' . $this->routeName . '.index')
                ->with('success_message', $update->message);
        }

        return back()
            ->withInput($request->input())
            ->with('error_message', $update->message);
    }

    public function show(Quiz $quiz): View|Application|Factory|ApplicationAlias
    {
        abort_if(Gate::denies($this->permissions['show']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $quiz->load('questions.answers')->loadCount('results');

        return view('dashboard.pages.' . $this->routeView . '.show', compact('quiz'));
    }
}
