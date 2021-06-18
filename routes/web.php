<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'customers'], function(){
    Route::get('', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('update/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('delete/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('show/{customer}', [CustomerController::class, 'show'])->name('customer.show');
});


Route::group(['prefix' => 'products'], function(){
    Route::get('', [ProductController::class, 'index'])->name('product.index');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::post('delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
});
