<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan milik user yang sedang login
        $orders = auth()->user()->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function show($orderCode)
    {
        // Cari pesanan berdasarkan kode, pastikan milik user yang login
        $order = Order::where('order_code', $orderCode)
            ->where('user_id', auth()->id())
            ->with('details.product') // Eager load produk per detail
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    public function cancel($orderCode)
    {
        // Hanya pesanan dengan status 'pending' yang bisa dibatalkan
        $order = Order::where('order_code', $orderCode)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $order->update(['status' => 'dibatalkan']);

        return redirect()->back()
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}