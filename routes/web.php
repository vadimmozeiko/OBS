<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('orders/{user}', [UserController::class, 'orders'])->name('user.orders');
        Route::get('password/{user}', [UserController::class, 'passEdit'])->name('user.passEdit');
        Route::post('password/{user}', [UserController::class, 'passUpdate'])->name('user.passUpdate');
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
});

Route::group(['prefix' => 'products'], function () {
    Route::get('', [ProductController::class, 'index'])->name('product.index');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::post('delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
});

