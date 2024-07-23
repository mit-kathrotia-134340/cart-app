<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.home');
});


Route::get('admin/login', function () {
    return view('admin.login');
})->name('login');

Route::post('admin/auth', [UserController::class, 'authenticate'])->name('auth');
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('home', function () {
        return view('admin.home');
    });

    Route::get('products', function () {
        return view('admin.products');
    })->name('products.index');
    Route::get('products/list', [ProductController::class,'list'])->name('products.list');
    Route::get('products/create', [ProductController::class,'create'])->name('products.create');
    Route::post('products/store', [ProductController::class,'store'])->name('products.store');
    Route::get('products/edit/{id}', [ProductController::class,'edit'])->name('products.edit');
    Route::post('products/update/{product}', [ProductController::class,'update'])->name('products.update');


    Route::get('categories', function () {
        return view('admin.categories');
    })->name('categories.index');
    Route::get('categories/list', [CategoryController::class,'list'])->name('categories.list');
    Route::get('categories/create', [CategoryController::class,'create'])->name('categories.create');
    Route::get('categories/store', [CategoryController::class,'store'])->name('categories.store');
    Route::get('categories/edit', [CategoryController::class,'edit'])->name('categories.edit');
    Route::get('categories/update', [CategoryController::class,'update'])->name('categories.update');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
