<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class setLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->header('lang') ? app()->setLocale($request->header('lang')) : app()->setLocale('ar');
        return $next($request);
    }
}
