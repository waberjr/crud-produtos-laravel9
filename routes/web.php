<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product');

Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.product.create');
Route::post('/admin/products/create', [AdminProductController::class, 'store'])->name('admin.product.store');

Route::get('/admin/products/{product}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');

Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
Route::delete('/admin/products/{product}/image', [AdminProductController::class, 'destroyImage'])->name('admin.product.destroyImage');
