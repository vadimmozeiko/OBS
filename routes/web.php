<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'products'], function(){
    Route::get('', [ProductController::class, 'index'])->name('product.index');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::post('delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
});
