<?php

use App\Models\User;
use App\Services\Salla\SallaClient;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect()->route('website.perfume-quiz');
});

Route::get('optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimized';
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return 'Installed';
});

//Route::get('project-install', function () {
//    Artisan::call('project:install');
//    return 'Installed';
//});

Route::get('add-migration/{path?}/{database?}', function ($path = '', $database = '') {
    $data = ['--force' => true];
    if (!empty($path) && ($path !== 'default')) {
        $call = 'migrate:refresh';
        $data['--path'] = '/database/migrations/' . $path . '.php';
    } else {
        $call = 'migrate';
    }
    if (!empty($database)) {
        $data['--database'] = $database;
    }
    Artisan::call($call, $data);
    return 'Migrated';
});

Route::get('class-seed/{name}/{database?}', function ($name, $database = '') {
    $data = ['--class' => $name, '--force' => true, '--no-interaction' => true];
    if (!empty($database)) {
        $data['--database'] = $database;
    }
    Artisan::call('db:seed', $data);
    return 'Class Seeded';
});

Route::get('restart-queue', function () {
    Artisan::call('queue:restart');
    dump('Queue Restarted');
});

Route::get('get-jobs', function () {
    $jobs = DB::table('jobs')->get();

    dump('Count: ' . $jobs->count());

    foreach ($jobs as $job) {
        dump($job);
    }
});

Route::get('get-failed-jobs', function () {
    $failedJobs = DB::table('failed_jobs')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();

    foreach ($failedJobs as $failedJob) {
        dump($failedJob);
    }
});


Route::get('salla-categories', function () {
    $user = User::first();
    return (new SallaClient())
        ->setToken($user->getSallaAccessToken())
        ->getHttpRequest(config('salla.urls.categories_list'));
});

Route::get('quiz-clients', function () {
    return \App\Models\Client::get(['id', 'key', 'email', 'phone']);
});
