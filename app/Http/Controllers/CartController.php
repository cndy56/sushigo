<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Ambil keranjang user + semua item + data produk
        $cart  = auth()->user()->cart;
        $items = $cart ? $cart->items()->with('product')->get() : collect();

        // Hitung total harga
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        // Buat keranjang jika belum ada (1 user = 1 keranjang)
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        // Cek apakah produk sudah ada di keranjang
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->increment('quantity', $request->quantity);
        } else {
            // Jika belum ada, buat item baru
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang! 🛒');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang!');
    }
}