<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()?->isVerified()) {
            return redirect()
                ->route('dashboard.profile.get-verification');
        }

        return $next($request);

    }
}
