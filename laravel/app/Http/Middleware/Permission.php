<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($routeName = \Route::currentRouteName()) {
            $permissions = config('permissions.keys', []);
            $permissionName = isset($permissions[$routeName])? $permissions[$routeName]: false;
            
            if (! $permissionName) return $next($request);

            if ($user = auth()->user()) {
                if ($user->id==1 OR $user->group_id==1) return $next($request);

                if ($group = \App\Models\UsersGroups::find($user->group_id)) {
                    $groupPermissions = is_array($group->permissions)? $group->permissions: [];

                    if (! in_array($routeName, $groupPermissions)) {
                        throw new \Exception('Você não tem permissão para '. mb_strtolower($permissionName));
                    }
                }
            }
        }

        return $next($request);
    }
}
