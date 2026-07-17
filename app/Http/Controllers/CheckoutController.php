<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;

        // Cegah checkout jika keranjang kosong
        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda masih kosong!');
        }

        $items = $cart->items()->with('product')->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ], [
            'notes.max' => 'Catatan maksimal 500 karakter.',
        ]);

        $cart = auth()->user()->cart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda masih kosong!');
        }

        $items = $cart->items()->with('product')->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        // Generate kode pesanan unik: SGO-YYYYMMDD-001
        $date      = now()->format('Ymd');
        $count     = Order::whereDate('created_at', today())->count() + 1;
        $orderCode = 'SGO-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        // DB Transaction: jika ada error, semua dibatalkan otomatis
        DB::transaction(function () use ($request, $items, $total, $orderCode, $cart) {

            // 1. Buat record pesanan
            $order = Order::create([
                'user_id'     => auth()->id(),
                'order_code'  => $orderCode,
                'status'      => 'pending',
                'total_price' => $total,
                'notes'       => $request->notes,
            ]);

            // 2. Buat detail pesanan per item
            foreach ($items as $item) {
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    // Simpan harga saat checkout agar tidak berubah jika harga produk diubah
                    'price'      => $item->product->price,
                ]);
            }

            // 3. Kosongkan keranjang
            $cart->items()->delete();
        });

        return redirect()->route('orders.show', $orderCode)
            ->with('success', 'Pesanan berhasil dibuat! Terima kasih telah memesan di SushiGo 🎉');
    }
}