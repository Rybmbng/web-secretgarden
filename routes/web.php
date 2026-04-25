<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Akses utama (/) langsung munculin Brand Story
Route::get('/', [HomeController::class, 'index'])->name('brand.index');

// Akses (/home) munculin Katalog Produk
Route::get('/home', [HomeController::class, 'home'])->name('products.home');