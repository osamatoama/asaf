<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Services\ClientService;
use Exception;
use Gate;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    private string $routeView;

    private array $permissions;

    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->routeView      = config('models.client.route_view') ?? '';
        $this->permissions    = config('models.client.permissions') ?? [];
        $this->clientService  = $clientService;
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): View|Application|Factory|ApplicationAlias|Response
    {
        abort_if(Gate::denies($this->permissions['access']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        if ($request->ajax() || $request->expectsJson()) {
            return $this->clientService
                ->getClients(['requestType' => 'datatable']);
        }

        $clients = $this->clientService
            ->getClients([
                'q'        => $request->q ?? null,
                'paginate' => (int)($request->paginate ?? GlobalConstants::PAGINATION_DEFAULT_COUNT),
                'page'     => (int)($request->page ?? 1),
            ]);

        return view('dashboard.pages.' . $this->routeView . '.index', compact('clients'));
    }

    public function show(Client $client): View|Factory|Application|ApplicationAlias|Response
    {
        abort_if(Gate::denies($this->permissions['show']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $client->loadCount('results');

        $passedQuizzes = $client->results()
            ->select('quiz_id')
            ->distinct()
            ->with('quiz')
            ->get();

        return view('dashboard.pages.' . $this->routeView . '.show', compact('client', 'passedQuizzes'));
    }
}
