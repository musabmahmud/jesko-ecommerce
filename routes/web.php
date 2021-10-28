<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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
// Route::get('/', function () {
//     return view('frontend.index');
// });
Route::get('/',[FrontEndController::class,'home'])->name('home');
Route::get('/products/{slug}',[FrontEndController::class,'productDetails'])->name('productDetails');
Route::get('/get/color/size/{color}/{productId}',[FrontEndController::class,'getSize'])->name('getSize');
Route::get('/customer-login',[FrontEndController::class,'customerLogin'])->name('customerLogin');
Route::get('/customer-register',[FrontEndController::class,'customerRegister'])->name('customerRegister');

//my-account
Route::get('/my-account',[FrontEndController::class,'myAccount'])->name('myAccount');

//cart
Route::get('/cart/empty',[CartController::class,'clearCart'])->name('clearCart');
Route::post('/cart/coupon/',[CartController::class,'getCoupon'])->name('getCoupon');
Route::resource('cart', CartController::class);

//checkout
Route::resource('checkout', CheckoutController::class);


//backend
Route::get('/dashboard',[BackendController::class,'backend'])->name('backend');

//category
Route::resource('category', CategoryController::class);
Route::get('/category-trashed',[CategoryController::class,'categorytrashed'])->name('categorytrashed');
Route::get('/category-recover/{id}',[CategoryController::class,'categoryrecovery'])->name('categoryrecovery');
//brand
Route::resource('brand', BrandController::class);
Route::get('/brand-trashed',[BrandController::class,'brandtrashed'])->name('brandtrashed');
Route::get('/brand-recovery/{id}',[BrandController::class,'brandrecovery'])->name('brandrecovery');
//color
Route::resource('color', ColorController::class);
//coupon
Route::resource('coupon', CouponController::class);
//role
Route::resource('role', RoleController::class);
Route::get('/role-view',[RoleController::class,'viewRole'])->name('viewRole');
Route::get('/role-assign',[RoleController::class,'assignUser'])->name('assignUser');
Route::post('/role-assign-store',[RoleController::class,'assignUserStore'])->name('assignUserStore');



//product
Route::resource('product', ProductController::class);
Route::get('/product-trashed',[ProductController::class,'producttrashed'])->name('producttrashed');
Route::get('/product-recovery/{id}',[ProductController::class,'productrecovery'])->name('productrecovery');

//attribute
Route::resource('attribute', AttributeController::class);
Route::get('/product-attribute-index/{id}',[AttributeController::class,'attributeIndex'])->name('attributeIndex');
Route::get('/product-attribute-create/{id}',[AttributeController::class,'attributeCreate'])->name('attributeCreate');

//gallery
Route::resource('gallery', GalleryController::class);
Route::get('/product-gallery-index/{id}',[GalleryController::class,'galleryIndex'])->name('galleryIndex');
Route::get('/product-gallery-create/{id}',[GalleryController::class,'galleryCreate'])->name('galleryCreate');

require __DIR__.'/auth.php';
