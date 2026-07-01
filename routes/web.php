<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AccountDetailController;
use App\Http\Controllers\Admin\VipRegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\VipDarshanController;


Route::get('/', [VipDarshanController::class, 'landing'])->name('vip.landing');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('site-settings', SiteSettingController::class);
    Route::resource('account-details', AccountDetailController::class);
    Route::resource('vip-registrations', VipRegistrationController::class);

});

Route::prefix('vip')->name('vip.')->group(base_path('routes/vip.php'));

require __DIR__.'/auth.php';
