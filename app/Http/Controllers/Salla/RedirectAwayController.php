<?php

namespace App\Http\Controllers\Salla;

use App\Http\Controllers\Controller;
use App\Services\Salla\SallaClient;
use Illuminate\Http\RedirectResponse;

/**
 * Class RedirectAwayController
 */
class RedirectAwayController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function __invoke()
    {
        return (new SallaClient())->redirectAway();
    }
}
