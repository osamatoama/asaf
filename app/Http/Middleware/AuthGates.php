<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        if (auth('admin')->check()) {
            $roles            = Role::with('permissions')->get();
            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }

            /**
             * Pass user role ids to callback by reference to fix query duplication
             */
            $userRoleIds = null;

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function (User $user) use ($roles, &$userRoleIds) {
                    if (empty($userRoleIds)) {
                        $userRoleIds = $user->roles()->pluck('roles.id')->toArray();
                    }

                    return count(array_intersect($userRoleIds, $roles)) > 0;
                });
            }
        }

        return $next($request);
    }
}
