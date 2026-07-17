<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Query dasar: hanya produk yang tersedia
        $query = Product::with('category')->where('is_available', true);

        // Filter berdasarkan kategori (via slug)
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Pencarian berdasarkan nama
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->get();
        $selectedCategory = $request->category;
        $searchQuery = $request->search;

        return view('menu.index', compact('categories', 'products', 'selectedCategory', 'searchQuery'));
    }

    public function show($slug)
    {
        // Cari produk berdasarkan slug, error 404 jika tidak ada
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        // Produk terkait dari kategori yang sama
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_available', true)
            ->take(4)
            ->get();

        return view('menu.show', compact('product', 'related'));
    }
}