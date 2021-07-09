<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;

class ReplaceGuard
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
        config(['auth.defaults.guard' => 'admin']);
        config(['auth.defaults.passwords' => 'admins']);
        \Config::set('activitylog.default_auth_driver', 'admin');
        \Config::set('activitylog.default_log_name', 'admin');

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url(route('admin.password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false));
        });

        return $next($request);
    }
}
