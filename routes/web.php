<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {

    // User::create(
    //     [
    //         'name' => 'admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => '1234'
    //     ]
    // );
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('signup', [AuthController::class, 'signupForm'])->name('signup');
Route::post('signup', [AuthController::class, 'signup']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// MY CODE
Route::middleware(['auth', 'roleControl'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/admin', [HomeController::class, 'showAdminHome'])->name('home.admin');
    Route::get('home/client', [HomeController::class, 'showClientHome'])->name('home.client');
});


// TON VIEUX CODE
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('home/admin', [HomeController::class, 'showAdminHome'])->name('home.admin');
// });

// Route::middleware(['auth', 'role:client'])->group(function () {
//     Route::get('home/client', [HomeController::class, 'showClientHome'])->name('home.client');
// });
