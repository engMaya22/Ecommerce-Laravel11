<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
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
    Route::get('/admin/brands', [BrandController::class, 'brands'])->name('admin.brands');

    Route::get('/admin/brands/add', [BrandController::class, 'addBrand'])->name('admin.brands.add');
    Route::post('/admin/brands/store', [BrandController::class, 'brandStore'])->name('admin.brand.store');

    Route::get('/admin/brands/edit/{id}', [BrandController::class, 'brandEdit'])->name('admin.brands.edit');
    Route::put('/admin/brands/update', [BrandController::class, 'brandUpdate'])->name('admin.brand.update');

    Route::delete('/admin/brand/{id}/delete',[BrandController::class,'brandDelete'])->name('admin.brand.delete');


});

// from template take header to replace in app b blade by it ,
//take body index from template to add to app blade
//  main of body index in template becomes yield to make the content reusable for different page
//          @include('user.account-nav') to divide components

//event.preventDefault() prevents the browser from following the link (navigating to route('logout') directly).
//document.getElementById('logout-form').submit() triggers the form submission via JavaScript.
// Storage::disk('public')  points to storage/app/public
//Storage::url() generates the public URL to access files stored in a specific disk. By default, it assumes you're using the public disk (which points to storage/app/public/).
