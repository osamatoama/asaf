<?php

namespace App\Services;

use App\Http\Requests\Dashboard\Quiz\UpdateRequest;
use App\Models\Quiz;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as CollectionAlias;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class QuizService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.quiz.route_view') ?? '';
        $this->permissions = config('models.quiz.permissions') ?? [];
        $this->routeName   = config('models.quiz.route_name') ?? '';
    }

    /**
     * @throws Exception
     */
    public function getQuizzes(array $filter = []): Quiz|LengthAwarePaginator|Builder|Collection|LengthAwarePaginatorAlias|CollectionAlias|JsonResponse
    {
        $quizzes = Quiz::withCount(['questions', 'results']);

        if (($filter['requestType'] ?? false) && ($filter['requestType'] === 'datatable')) {
            return $this->prepareDatatable($quizzes);
        }

        if (($filter['asc'] ?? false)) {
            $quizzes = $quizzes->oldest('id');
        } else {
            $quizzes = $quizzes->latest('id');
        }
        $params = [];

        if ($filter['q'] ?? false) {
            $quizzes = $quizzes->where(function ($q) use ($filter) {
                $q->where('id', $filter['q'])
                    ->orWhere('title', 'like', '%' . $filter['q'] . '%');
            });
            $params['q'] = $filter['q'];
        }

        if ($filter['pluck'] ?? false) {
            return $quizzes->pluck('title', 'id');
        }

        if ($filter['paginate'] ?? false) {
            $quizzes = $quizzes->paginate((int)$filter['paginate']);
            $params['paginate'] = (int)$filter['paginate'];

            if ($filter['page'] ?? false) {
                $params['page'] = (int)$filter['page'];
            }
            if (!empty($params)) {
                $quizzes = $quizzes->appends($params);
            }
            return $quizzes;
        }

        return $quizzes->get();
    }

    /**
     * @throws Exception
     */
    public function getPluckProducts(array $filter = []): Collection|LengthAwarePaginator|Builder|LengthAwarePaginatorAlias|JsonResponse|CollectionAlias|Quiz
    {
        $filter = Arr::except($filter, 'requestType');
        $filter['pluck'] = true;

        return $this->getQuizzes($filter);
    }

    public function update(UpdateRequest $request, Quiz $quiz): object
    {

        DB::beginTransaction();
        try {
            $quiz->update($request->validated());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل الاختبار بنجاح',
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
     * @throws Exception
     */
    private function prepareDatatable($query): JsonResponse
    {
        $table = DataTables::of($query);

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

        $table->editColumn('id', function (Quiz $row) {
            return $row->id ?? '';
        });
        $table->editColumn('questions_count', function (Quiz $row) {
            return $row->questions_count ?? 0;
        });
        $table->editColumn('results_count', function (Quiz $row) {
            return $row->results_count ?? 0;
        });


        $table->rawColumns(['actions', 'placeholder']);

        return $table->make();
    }
}
