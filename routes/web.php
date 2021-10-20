<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
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
Route::get('/category-trashed',[CategoryController::class,'categorytrashed'])->name('categorytrashed');
Route::get('/category-recover/{id}',[CategoryController::class,'categoryrecovery'])->name('categoryrecovery');


Route::resource('brand', BrandController::class);
Route::get('/brand-trashed',[BrandController::class,'brandtrashed'])->name('brandtrashed');
Route::get('/brand-recovery/{id}',[BrandController::class,'brandrecovery'])->name('brandrecovery');


Route::resource('product', ProductController::class);
Route::get('/product-trashed',[ProductController::class,'producttrashed'])->name('producttrashed');
Route::get('/product-recovery/{id}',[ProductController::class,'productrecovery'])->name('productrecovery');

Route::resource('attribute', AttributeController::class);
Route::get('/product-attribute-index/{id}',[AttributeController::class,'attributeIndex'])->name('attributeIndex');
Route::get('/product-attribute-create/{id}',[AttributeController::class,'attributeCreate'])->name('attributeCreate');

Route::resource('gallery', GalleryController::class);


// Route::post('/cart-update',[CartController::class,'cartUpdate'])->name('cartUpdate');
// Route::get('/cart-remove/{id}',[CartController::class,'cartDestroy'])->name('cartDestroy');
// Route::post('/cart-coupon',[CartController::class,'couponGet'])->name('couponGet');
// Route::get('/cart-destroy',[CartController::class,'couponDestroy'])->name('couponDestroy');

















require __DIR__.'/auth.php';
