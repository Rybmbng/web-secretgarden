<?php
namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman berdasarkan slug
     */
    public function show($slug = 'brand')
    {
        // Cari data halaman berdasarkan slug (defaultnya 'brand')
        $page = Page::where('slug', $slug)->firstOrFail();

        return Inertia::render('Brand', [
            'page' => [
                'title' => $page->title,
                'content' => $page->content, // Ini berisi array blok dari Builder Filament
            ]
        ]);
    }
}