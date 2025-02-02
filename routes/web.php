<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');


});
Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

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


    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/product/add', [ProductController::class, 'productAdd'])->name('admin.products.add');
    Route::post('/admin/product/store', [ProductController::class, 'productStore'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'productEdit'])->name('admin.product.edit');
    Route::put('/admin/product/update', [ProductController::class, 'productUpdate'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete',[ProductController::class,'productDelete'])->name('admin.product.delete');



    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


});

// from template take header to replace in app b blade by it ,
//take body index from template to add to app blade
//  main of body index in template becomes yield to make the content reusable for different page
//          @include('user.account-nav') to divide components

//event.preventDefault() prevents the browser from following the link (navigating to route('logout') directly).
//document.getElementById('logout-form').submit() triggers the form submission via JavaScript.
// Storage::disk('public')  points to storage/app/public
//Storage::url() generates the public URL to access files stored in a specific disk. By default, it assumes you're using the public disk (which points to storage/app/public/).
