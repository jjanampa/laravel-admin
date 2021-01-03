<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guestAdmin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('admin.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    public function guard(): StatefulGuard
    {
        return Auth::guard('admin');
    }

    /**
     * Where to redirect users after login.
     * @return string
     */
    protected function redirectTo(): string
    {
        return route('admin.dashboard');
    }
}
