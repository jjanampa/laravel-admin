<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Admin\Http\Requests\ProfileRequest;
use Modules\Admin\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return View
     */
    public function edit(): View
    {
        return view('admin::dashboard.profile.edit');
    }

    /**
     * Update the profile
     *
     * @param ProfileRequest;  $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        auth('admin')->user()->update($request->all());

        return back()->with('success', __('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param PasswordRequest $request
     * @return RedirectResponse
     */
    public function password(PasswordRequest $request): RedirectResponse
    {
        auth('admin')->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('success', __('Password successfully updated.'));
    }
}
