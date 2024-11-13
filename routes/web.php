<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\http\Controllers\User\UserController;

//guest route
Route::group(['middleware'=>'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');

    Route::post('/post-login', [AuthController::class, 'login']);
})->middleware('guest');

//admin route
Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//product Route
Route::get('/product', [ProductController::class, 'index'])->name('admin.product');

Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
})->middleware('admin');

//user route
Route::group(['middleware' => 'web'], function() {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');
})->middleware('web');
