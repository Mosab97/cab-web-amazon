<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $locale = app()->getLocale();
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->user_type == 'superadmin' || Auth::user()->user_type == 'admin') {
                return redirect(route($request->route()->getName() == 'dashboard.login' ? 'dashboard.home' : $request->route()->getName()));
            }
            return redirect(RouteServiceProvider::HOME);

        }

        return $next($request);
    }
}
