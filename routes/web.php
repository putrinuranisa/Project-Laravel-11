<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DistributorController;
use App\Imports\DistributorImport;
use App\http\Controllers\User\UserController;
use App\Http\Controllers\ListController;
use App\Models\User;
use App\Models\Admin;
use App\Models\Distributor;

//guest route
Route::group(['middleware'=>'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/register', function () {
        return view('register');
    })->name('register');
    

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');

    Route::post('/post-login', [AuthController::class, 'login']);
})->middleware('guest');
    
//admin route
Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//distributor
Route::get('/distributor', [DistributorController::class, 'index'])->name('admin.distributor');

    Route::post('/distributor/import', [DistributorController::class, 'import'])->name('distributor.import');
    Route::get('/distributor/export', [DistributorController::class, 'export'])->name('distributor.export');

    Route::get('/admin/distributor/create', [DistributorController::class, 'create'])->name('admin.distributor.create');
    Route::post('/admin/distributor/store', [DistributorController::class, 'store'])->name('distributor.store');
    Route::get('/admin/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('admin.distributor.edit');
    Route::post('/admin/distributor/update/{id}', [DistributorController::class, 'update'])->name('admin.distributor.update');
    Route::delete('/admin/distributor/delete', [DistributorController::class, 'delete'])->name('distributor.delete');

    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('distributor.edit');
    Route::post('/distributor/update/{id}', [DistributorController::class, 'update'])->name('distributor.update');
    Route::get('/distributor/create', [DistributorController::class, 'create'])->name('distributor.create');
    Route::delete('/distributor/delete/{id}', [DistributorController::class, 'delete'])->name('distributor.delete');

//product Route
Route::get('/product', [ProductController::class, 'index'])->name('admin.product');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('/admin/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');

    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
})->middleware('admin');

// Discount Route
    Route::get('/user/flash-sale', [UserController::class, 'flashSale'])->name('user.flashSale');
    Route::post('/admin/product/{productId}/set-discount', [AdminController::class, 'setDiscount'])->name('admin.setDiscount');

//user route
Route::group(['middleware' => 'web'], function() {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/flashsale', [UserController::class, 'fs'])->name('user.fs');

    Route::get('/user/product/detail/{id}', [UserController::class, 'detail_product'])->name('user.detail.product');
    Route::get('/product/purchase/{productId}/{userId}', [UserController::class, 'purchase']);

    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');
})->middleware('web');