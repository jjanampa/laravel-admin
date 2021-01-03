<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplaceLogGuard
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            \Config::set('activitylog.default_auth_driver', 'admin');
            \Config::set('activitylog.default_log_name', 'admin');
        }

        return $next($request);
    }
}
