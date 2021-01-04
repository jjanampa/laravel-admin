<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::name('admin.')->prefix('admin')->middleware(['replaceLogGuard'])->group(function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

});

Route::name('admin.')->prefix('admin')->middleware(['authAdmin', 'replaceLogGuard'])->group(function() {

    Route::get('/', 'Dashboard\IndexController@index')->name('dashboard');

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Dashboard\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'Dashboard\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Dashboard\ProfileController@password']);

    Route::resource('roles', 'Dashboard\RolesController');
    Route::resource('permissions', 'Dashboard\PermissionsController');
    Route::resource('users', 'Dashboard\UsersController');
    Route::resource('pages', 'Dashboard\PagesController');
    Route::resource('activitylogs', 'Dashboard\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('settings', 'Dashboard\SettingsController');
});
