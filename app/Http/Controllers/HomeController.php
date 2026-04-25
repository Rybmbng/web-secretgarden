<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Menampilkan SEMUA postingan halaman secara berurutan
     */
    public function index()
    {
        // Ambil semua data page, urutkan dari yang paling lama/baru atau custom
        $pages = Page::orderBy('created_at', 'asc')->get();

        return Inertia::render('Index', [
            'pages' => $pages 
        ]);
    }

    public function home()
    {
        // Logic home untuk produk tetap sama
        return Inertia::render('Home', [
            'products' => Product::where('is_active', true)->with(['category', 'variants.images'])->latest()->paginate(12),
            'categories' => ProductCategory::where('is_active', true)->get(),
        ]);
    }
}