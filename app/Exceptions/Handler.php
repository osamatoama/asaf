<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response as Response_2;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse|Response_2
    {
        if($request->expectsJson()) {
            return $this->renderJson($request, $e);
        }

        if ($this->isDashboardRequest($request)) {
            return $this->renderDashboard($request, $e);
        }

        return $this->renderWebsite($request, $e);
    }

    protected function isDashboardRequest(Request $request): bool
    {
        return $request->is('dashboard/*')
                || in_array($request->route()?->getName(), [
                    'login',
                    'logout',
                    'password.email',
                    'password.verify-code',
                    'password.update',
                ]);
    }

    /**
     * @throws Throwable
     */
    protected function renderJson(Request $request, Throwable $e): Response|JsonResponse|Response_2|RedirectResponse
    {
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return response()->dashboard()->json(false, 'Resource not found!', [], 419);
        }

        if ($e instanceof TokenMismatchException) {
            return response()->dashboard()->json(false, 'Page expired!', [], 419);
        }

        return parent::render($request, $e);
    }

    /**
     * @throws Throwable
     */
    protected function renderDashboard(Request $request, Throwable $e): Response|JsonResponse|Response_2|RedirectResponse
    {
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return response()->view('dashboard.errors.404', [], 404);
        }

        if ($e instanceof TokenMismatchException) {
            return response()->view('dashboard.errors.419', [], 419);
        }

        return parent::render($request, $e);
    }

    /**
     * @throws Throwable
     */
    protected function renderWebsite(Request $request, Throwable $e): Response|JsonResponse|Response_2|RedirectResponse
    {
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return response()->view('dashboard.errors.404', [], 404);
        }

        if ($e instanceof TokenMismatchException) {
            return response()->view('dashboard.errors.419', [], 419);
        }

        return parent::render($request, $e);
    }
}
