<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Semua kategori untuk ditampilkan
        $categories = Category::withCount('products')->get();

        // 8 produk terbaru yang tersedia
        $products = Product::with('category')
            ->where('is_available', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('categories', 'products'));
    }
}