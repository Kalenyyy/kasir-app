<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

    Route::fallback(function () {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::middleware('IsAdmin')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'GetIdUser']);
            Route::patch('/update/{id}', [UserController::class, 'update']);
            Route::delete('/delete/{id}', [UserController::class, 'destroy']);
        });

        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            // Route::get('/edit/{id}', [CategoryController::class, 'GetIdCategory']);
            // Route::patch('/update/{id}', [CategoryController::class, 'updateCategory']);
            // Route::delete('/delete/{id}', [CategoryController::class, 'destroyCategory']);
        });
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');

        Route::middleware('IsAdmin')->group(function () {
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'GetIdProduct']);
            Route::patch('/update-stock/{id}', [ProductController::class, 'updateStock']);
            Route::patch('/update-product/{id}', [ProductController::class, 'updateProduct']);
            Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
        });
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/checkout', [OrderController::class, 'showCheckout'])->name('process');
        Route::post('/checkout/store', [OrderController::class, 'checkout'])->name('store');
        Route::get('/checkout/member', [OrderController::class, 'showCheckoutMember'])->name('show-checkout-member');
        Route::post('/checkout/member/store', [OrderController::class, 'storeOrderMember'])->name('store-order-member');
        Route::get('/checkout/member/detail-order/{id}', [OrderController::class, 'showDetailOrderMember'])->name('detail-order-member');
        Route::get('/check-order/{id}', [OrderController::class, 'GetIdOrder']);
    });
});
