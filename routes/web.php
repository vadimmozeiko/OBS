<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/products/all', [HomeController::class, 'products'])->name('products');



Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('orders/{user}', [UserController::class, 'orders'])->name('user.orders');
        Route::get('password/{user}', [UserController::class, 'passEdit'])->name('user.passEdit');
        Route::post('password/{user}', [UserController::class, 'passUpdate'])->name('user.passUpdate');
        Route::post('password/reset/{user}', [UserController::class, 'passFirstReset'])->name('user.passFirstReset');
        Route::get('deleteConfirm/{user}', [UserController::class, 'deleteConfirm'])->name('user.deleteConfirm');
        Route::post('delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [OrderController::class, 'index'])->name('order.index');
        Route::get('create/{product}', [OrderController::class, 'create'])->name('order.create');
        Route::post('store', [OrderController::class, 'store'])->name('order.store');
        Route::get('edit/{order}', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('update/{order}', [OrderController::class, 'update'])->name('order.update');
        Route::post('delete/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
        Route::get('show/{order}', [OrderController::class, 'show'])->name('order.show');
    });

    Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
        Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('login/{user}', [DashboardController::class, 'loginAs'])->name('login.as');

        Route::group(['prefix' => 'orders'], function () {
            Route::get('', [DashboardController::class, 'listOrder'])->name('list.order');
            Route::get('create', [DashboardController::class, 'createOrder'])->name('create.order');
            Route::post('store', [DashboardController::class, 'storeOrder'])->name('store.order');
            Route::post('change/{order}', [DashboardController::class, 'statusChange'])->name('change.order');
            Route::get('edit/{order}', [DashboardController::class, 'editOrder'])->name('edit.order');
            Route::post('update/{order}', [DashboardController::class, 'updateOrder'])->name('update.order');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::post('store', [UserController::class, 'store'])->name('user.store');
            Route::get('', [DashboardController::class, 'listUser'])->name('list.user');
            Route::get('edit/{user}', [DashboardController::class, 'editUser'])->name('edit.user');
            Route::post('update/{user}', [DashboardController::class, 'updateUser'])->name('update.user');
            Route::post('reset/{user}', [UserController::class, 'passReset'])->name('pass.reset');
        });
    });
});

Route::group(['prefix' => 'products'], function () {
    Route::get('', [ProductController::class, 'index'])->name('product.index');
    Route::get('details/{product}', [ProductController::class, 'details'])->name('product.details');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::post('change/{product}', [ProductController::class, 'changeStatus'])->name('product.changeStatus');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
});

