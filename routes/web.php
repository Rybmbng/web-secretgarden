<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

// Akses utama (/) langsung munculin Brand Story
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');

// Akses (/home) munculin Katalog Produk
Route::get('/', [HomeController::class, 'index'])->name('products.home');