@extends('layouts.user')
@section('title', 'Keranjang Saya')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">🛒 Keranjang Saya</h1>

    @if($items->isEmpty())
    {{-- Keranjang Kosong --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-16 text-center">
        <div class="text-8xl mb-6">🛒</div>
        <h2 class="text-2xl font-bold text-gray-700 mb-3">Keranjang masih kosong</h2>
        <p class="text-gray-400 mb-8">Tambahkan menu sushi favorit Anda ke keranjang.</p>
        <a href="{{ route('menu.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white font-semibold px-10 py-3.5 rounded-xl transition-all inline-block">
            Lihat Menu
        </a>
    </div>

    @else
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- ── Daftar Item ──────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($items as $item)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-5">
                {{-- Gambar --}}
                <div class="w-20 h-20 bg-red-50 rounded-2xl overflow-hidden flex-shrink-0">
                    @if($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-3xl">🍣</div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 truncate">{{ $item->product->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->product->category->name }}</p>
                    <p class="text-red-600 font-bold mt-1">
                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Update Qty --}}
                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                           class="w-16 border border-gray-200 rounded-lg px-2 py-1.5 text-center text-sm focus:outline-none focus:ring-2 focus:ring-red-300">
                    <button type="submit"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-medium px-3 py-2 rounded-lg transition-colors">
                        Update
                    </button>
                </form>

                {{-- Subtotal --}}
                <div class="text-right flex-shrink-0">
                    <p class="font-bold text-gray-800 text-sm">
                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Hapus --}}
                <form action="{{ route('cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach

            <a href="{{ route('menu.index') }}" class="inline-block text-sm text-gray-400 hover:text-red-600 transition-colors mt-2">
                ← Lanjutkan Belanja
            </a>
        </div>

        {{-- ── Ringkasan Order ──────────────────────────── --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                <h2 class="font-bold text-gray-800 text-lg mb-5">Ringkasan Pesanan</h2>

                <div class="space-y-3 mb-5">
                    @foreach($items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 truncate pr-2">{{ $item->product->name }} ×{{ $item->quantity }}</span>
                        <span class="text-gray-800 font-medium flex-shrink-0">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 mb-6">
                    <div class="flex justify-between font-bold text-gray-800">
                        <span>Total</span>
                        <span class="text-red-600 text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Tombol Checkout (Tahap 6) --}}
                <a href="{{ route('checkout.index') }}"
                   class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl transition-all text-center shadow-md hover:shadow-lg">
                    Lanjut ke Checkout →
                </a>

                <p class="text-xs text-gray-400 text-center mt-3">
                    Pesanan akan diproses setelah checkout.
                </p>
            </div>
        </div>

    </div>
    @endif

</div>

@endsection