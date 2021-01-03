<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\View\View;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authAdmin');
    }

    /**
     * Display the password confirmation view.
     *
     * @return View
     */
    public function showConfirmForm(): View
    {
        return view('admin::auth.passwords.confirm');
    }

    /**
     * Where to redirect users when the intended url fails.
     * @return string
     */
    protected function redirectTo(): string
    {
        return route('admin.dashboard');
    }
}
