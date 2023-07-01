<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'admin:roles'])->group(function () {
    Route::get('home/admin', [HomeController::class, 'showAdminHome'])->name('home.admin');
});

Route::middleware(['auth', 'client:roles'])->group(function () {
    Route::get('home/client', [HomeController::class, 'showClientHome'])->name('home.client');
});
