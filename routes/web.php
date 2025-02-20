<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Account\UsernamePasswordController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\User\SearchUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function (Request $request) {
    if ($request->user()?->role == 'admin') {
        return redirect()->route('admin.dashboard')->with('toasts', session()->get('toasts'));
    } 

    return redirect()->route('user.dashboard');
})->name('dashboard');

Route::prefix('account')->middleware('authenticate')->group(function () {
    Route::prefix('/profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('profile.index');
        Route::post('/{user}', 'update')->name('profile.update');
    });
    Route::prefix('/username-password')->controller(UsernamePasswordController::class)->group(function () {
        Route::get('/', 'index')->name('username-password.index');
        Route::patch('/username/{user}', 'updateUsername')->name('username-password.update-username');
        Route::patch('/password/{user}', 'updatePassword')->name('username-password.update-password');
    });
});

Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'store')->middleware('guest');
    Route::post('/logout', 'destroy')->name('logout')->middleware('authenticate');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });

    Route::resource('users', UsersController::class);
    Route::post('/users/{user}', [UsersController::class, 'update'])->name('users.update');
});

Route::prefix('user')->group(function () {
    Route::controller(\App\Http\Controllers\User\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
    });
    Route::controller(SearchUserController::class)->group(function () {
        Route::get('/search-user', 'index')->name('user.search-user.index');
        Route::get('/search-user/{user}', 'show')->name('user.search-user.show');
    });
});
