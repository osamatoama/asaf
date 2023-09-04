<?php

namespace App\Http\Controllers\Salla;

use App\Http\Controllers\Controller;
use App\Services\Salla\SallaClient;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class CallbackController
 */
class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @return Application|FoundationApplication|RedirectResponse|Redirector
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        return (new SallaClient())->handleCallback($request);
    }
}
