<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;

class BrandController extends Controller
{
   
    public function index()
    {
        $pages = Page::orderBy('created_at', 'asc')->get();
        return Inertia::render('Brand/Index', [
            'pages' => $pages 
        ]);
    }
}