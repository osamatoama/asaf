<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Services\QuizService;
use App\Helpers\GlobalConstants;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Dashboard\Quiz\UpdateRequest;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;

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

    public function update(UpdateRequest $request, Quiz $quiz): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $update = $this->quizService->update($request, $quiz);

        if ($update->success) {
            return response()->json([
                'success' => true,
                'message' => $update->message,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $update->message,
        ], 500);
    }

    public function show(Quiz $quiz): View|Application|Factory|ApplicationAlias
    {
        abort_if(Gate::denies($this->permissions['show']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $quiz->load('questions.answers')->loadCount('results');

        return view('dashboard.pages.' . $this->routeView . '.show', compact('quiz'));
    }
}
