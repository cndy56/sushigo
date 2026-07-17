<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalOrders     = Order::count();
        $totalUsers      = User::where('role', 'user')->count();
        // Ambil 5 pesanan terbaru beserta data user
        $recentOrders    = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalCategories',
            'totalOrders', 'totalUsers', 'recentOrders'
        ));
    }
}