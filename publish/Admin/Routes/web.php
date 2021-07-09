<?php

use Modules\Admin\Http\Controllers\Auth\LoginController;
use Modules\Admin\Http\Controllers\Auth\ForgotPasswordController;
use Modules\Admin\Http\Controllers\Auth\ResetPasswordController;
use Modules\Admin\Http\Controllers\Dashboard\IndexController;
use Modules\Admin\Http\Controllers\Dashboard\ProfileController;
use Modules\Admin\Http\Controllers\Dashboard\RolesController;
use Modules\Admin\Http\Controllers\Dashboard\PermissionsController;
use Modules\Admin\Http\Controllers\Dashboard\UsersController;
use Modules\Admin\Http\Controllers\Dashboard\PagesController;
use Modules\Admin\Http\Controllers\Dashboard\ActivityLogsController;
use Modules\Admin\Http\Controllers\Dashboard\SettingsController;

Route::name('admin.')->prefix('admin')->middleware(['replaceGuard'])->group(function() {
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

});

Route::name('admin.')->prefix('admin')->middleware(['authAdmin', 'replaceGuard'])->group(function() {

    Route::get('/', [IndexController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');

    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('pages', PagesController::class);
    Route::resource('activitylogs', ActivityLogsController::class)->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('settings', SettingsController::class);
});
