<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;

Route::get('/', function () {
  return view('welcome');
});


Route::namespace('Admin')
  ->group(function () {
    Route::prefix('control/admin')->group(function () {
      Route::namespace('Auth')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
        Route::post('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
        Route::post('register', [RegisterController::class, 'register'])->name('admin.register');
      });

      // Dashboard routes with middleware and 'admin.' prefix for names
      Route::middleware('auth:admin')
        ->namespace('Dashboard')
        ->prefix('dashboard')
        ->as('admin.')
        ->group(function () {
          Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
          Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
          Route::post('profile/update', [DashboardController::class, 'update'])->name('profile.update');
          Route::post('profile/password', [DashboardController::class, 'password'])->name('profile.password');
        });
    });
  });

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
