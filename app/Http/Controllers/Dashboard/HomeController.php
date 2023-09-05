<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        abort(403, 'Coming Soon...');
    }
}
