<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');



Route::resource('category', CategoryController::class);
// Route::post('/cart-update',[CartController::class,'cartUpdate'])->name('cartUpdate');
// Route::get('/cart-remove/{id}',[CartController::class,'cartDestroy'])->name('cartDestroy');
// Route::post('/cart-coupon',[CartController::class,'couponGet'])->name('couponGet');
// Route::get('/cart-destroy',[CartController::class,'couponDestroy'])->name('couponDestroy');

















require __DIR__.'/auth.php';
