<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return View
     */
    public function showLinkRequestForm(): View
    {
        return view('admin::auth.passwords.email');
    }

    /**
     * password broker for admin guard.
     *
     * @return PasswordBroker
     */
    public function broker(): PasswordBroker
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     *
     * @return StatefulGuard
     */
    public function guard(): StatefulGuard
    {
        return Auth::guard('admin');
    }
}
