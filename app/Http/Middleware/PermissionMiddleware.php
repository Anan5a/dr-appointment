<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = null, $guard = null): Response|RedirectResponse
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (! is_null($permission)) {
            $permissions = is_array($permission)
                ? $permission
                : explode('|', $permission);
        }

        if ( is_null($permission) ) {
            $permission = $request->route()->getName();
            $permissions = array($permission);
        }


        foreach ($permissions as $permission) {
            if (!$authGuard->user()->can($permission)) {
                throw UnauthorizedException::forPermissions($permissions);

                return redirect('/')->withErrors(['message'=>'You do not have permission for performing the action']);
//                throw UnauthorizedException::forPermissions($permissions);
            }
        }
        return $next($request);

    }
}
