<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// from template take header to replace in app b blade by it ,
//take body index from template to add to app blade
//  main of body index in template becomes yield to make the content reusable for different page
