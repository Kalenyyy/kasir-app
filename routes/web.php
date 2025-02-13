<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('IsLogin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('IsAdmin')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'GetIdUser']);
            Route::patch('/update/{id}', [UserController::class, 'update']);
        });
    });

});
