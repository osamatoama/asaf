<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        $statistics = [];
        return view('dashboard.pages.home.index', compact('statistics'));
    }
}
