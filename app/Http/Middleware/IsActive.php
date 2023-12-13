<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class IsActive
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
        if (!authUser()?->isActive()) {
            auth('admin')->logout();
            return redirect()
                ->route('login')
                ->with('error_message', 'الحساب غير مفعل. يرجى التواصل مع الإدارة');
        }

        return $next($request);

    }
}
