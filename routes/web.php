<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'details'])->name('shop.product.view');
//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increaseCartQuantity'])->name('cart.qty.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decreaseCartQuantity'])->name('cart.qty.decrease');
Route::delete('/cart/remove/{rowId}',[CartController::class , 'removeItem'])->name('cart.item.remove');
Route::delete('/cart/clear',[CartController::class , 'emptyCart'])->name('cart.empty');


Route::post('/cart/coupon-apply', [CouponController::class, 'applyCouponCode'])->name('cart.coupon.apply');
Route::delete('/cart/coupon-remove',[CouponController::class,'removeCouponCode'])->name('cart.coupon.remove');


//wishlist
Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{rowId}',[WishlistController::class , 'removeItem'])->name('wishlist.item.remove');
Route::delete('/wishlist/clear',[WishlistController::class , 'emptyWishlist'])->name('wishlist.empty');
Route::post('/wishlist/move-to-cart/{rowId}',[WishlistController::class , 'moveToCart'])->name('wishlist.move.to.cart');


Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');

    Route::get('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
    Route::post('/order-place',[CartController::class,'placeOrder'])->name('order.place');
    Route::get('/order-confirmation',[CartController::class,'orderConfirm'])->name('order.confirm');



});
Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //coupons
    Route::get('/admin/coupons',[CouponController::class,'index'])->name('admin.coupons');
    Route::get('/admin/coupon/add',[CouponController::class,'couponAdd'])->name('admin.coupon.add');
    Route::post('/admin/coupon/store',[CouponController::class,'couponStore'])->name('admin.coupon.store');
    Route::get('/admin/coupon/edit/{id}',[CouponController::class,'couponEdit'])->name('admin.coupon.edit');
    Route::put('/admin/coupon/update',[CouponController::class,'couponUpdate'])->name('admin.coupon.update');
    Route::delete('/admin/coupon/{id}/delete',[CouponController::class,'couponDelete'])->name('admin.coupon.delete');

    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands');
    Route::get('/admin/brands/add', [BrandController::class, 'addBrand'])->name('admin.brands.add');
    Route::post('/admin/brands/store', [BrandController::class, 'brandStore'])->name('admin.brand.store');
    Route::get('/admin/brands/edit/{id}', [BrandController::class, 'brandEdit'])->name('admin.brand.edit');
    Route::put('/admin/brands/update', [BrandController::class, 'brandUpdate'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete',[BrandController::class,'brandDelete'])->name('admin.brand.delete');

    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/category/add', [CategoryController::class, 'categoryAdd'])->name('admin.category.add');
    Route::post('/admin/category/store', [CategoryController::class, 'categoryStore'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin.category.edit');
    Route::put('/admin/category/update', [CategoryController::class, 'categoryUpdate'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete',[CategoryController::class,'categoryDelete'])->name('admin.category.delete');
//make group name
//make factory data + description html rich editor

    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/product/add', [ProductController::class, 'productAdd'])->name('admin.products.add');
    Route::post('/admin/product/store', [ProductController::class, 'productStore'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'productEdit'])->name('admin.product.edit');
    Route::put('/admin/product/update', [ProductController::class, 'productUpdate'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete',[ProductController::class,'productDelete'])->name('admin.product.delete');


    Route::get('/admin/orders',[OrderController::class,'index'])->name('admin.orders');



});

// from template take header to replace in app b blade by it ,
//take body index from template to add to app blade
//  main of body index in template becomes yield to make the content reusable for different page
//          @include('user.account-nav') to divide components

//event.preventDefault() prevents the browser from following the link (navigating to route('logout') directly).
//document.getElementById('logout-form').submit() triggers the form submission via JavaScript.
// Storage::disk('public')  points to storage/app/public
//Storage::url() generates the public URL to access files stored in a specific disk. By default, it assumes you're using the public disk (which points to storage/app/public/).

// if i have href but i want to submit form by it javascript:void(0) to href to prevent href behavoir :
//  <form method="POST" action="{{route('wishlist.add')}}" id="wishlist-form">
// @csrf
// <input type="hidden"  name="id" value="{{$product->id}}"/>
// <input type="hidden"  name="name" value="{{$product->name}}"/>

// <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist"
//                     onclick="document.getElementById('wishlist-form').submit();"><svg width="16" height="16" viewBox="0 0 20 20"
//     fill="none" xmlns="http://www.w3.org/2000/svg">
//     <use href="#icon_heart" />
//   </svg><span>Add to Wishlist</span>
// </a>
// </form>
