<?php

namespace App\Providers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->withWhereHas();
        $this->response();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    protected function response(): void
    {
        foreach (['dashboard', 'website'] as $value) {
            Response::macro($value, function () {
                return new class {
                    public function json(bool $success, ?string $message = null, array $data = [], int $code = 200): JsonResponse
                    {
                        unset($data['success'], $data['message']);

                        return Response::json(array_merge([
                            'status'  => $code,
                            'success' => $success,
                            'message' => $message ?? '',
                        ], $data), $code);
                    }

                    public function success(?string $message = null, array $data = [], int $code = 200): JsonResponse
                    {
                        return $this->json(true, $message, $data, $code);
                    }

                    public function error(?string $message = null, array $data = [], int $code = 200): JsonResponse
                    {
                        return $this->json(false, $message, $data, $code);
                    }
                };
            });
        }
    }

    protected function withWhereHas(): void {
        Builder::macro(
            'withWhereHas',
            function ($relation, Closure $callback = null, $operator = '>=', $count = 1)
            {
                return $this->whereHas(Str::before($relation, ':'), $callback, $operator, $count)
                    ->with($callback ? [
                        $relation => function ($query) use ($callback) {
                            return $callback($query);
                        }] : $relation);
            }
        );
    }
}
