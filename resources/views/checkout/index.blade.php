@extends('layouts.user')
@section('title', 'Checkout')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Konfirmasi Pesanan</h1>
        <p class="text-gray-500 mt-1">Periksa pesanan Anda sebelum dikonfirmasi.</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- ── Kiri: Daftar Item ─────────────────────── --}}
            <div class="lg:col-span-2 space-y-4">

                <h2 class="font-semibold text-gray-700">Item yang Dipesan</h2>

                @foreach($items as $item)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                    {{-- Gambar --}}
                    <div class="w-16 h-16 bg-red-50 rounded-xl overflow-hidden flex-shrink-0">
                        @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-2xl">🍣</div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-400">{{ $item->product->category->name }}</p>
                    </div>

                    {{-- Qty & Subtotal --}}
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm text-gray-500">{{ $item->quantity }} × Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <p class="font-bold text-gray-800 mt-0.5">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @endforeach

                {{-- Catatan --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        📝 Catatan Pesanan <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="notes" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 resize-none"
                              placeholder="Contoh: tidak pakai wasabi, tambah soy sauce, dll...">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('cart.index') }}"
                   class="inline-block text-sm text-gray-400 hover:text-red-600 transition-colors">
                    ← Kembali ke Keranjang
                </a>
            </div>

            {{-- ── Kanan: Ringkasan & Konfirmasi ─────────── --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-gray-800 text-lg mb-5">Ringkasan Pesanan</h2>

                    <div class="space-y-3 mb-5">
                        @foreach($items as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 truncate pr-2">{{ $item->product->name }} ×{{ $item->quantity }}</span>
                            <span class="font-medium text-gray-800 flex-shrink-0">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 mb-6">
                        <div class="flex justify-between font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-red-600 text-xl">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Info Status Awal --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-3 mb-5">
                        <p class="text-xs text-yellow-700 font-medium">
                            ⏳ Status awal pesanan: <strong>Menunggu</strong>
                        </p>
                        <p class="text-xs text-yellow-600 mt-1">
                            Admin akan memproses pesanan Anda segera.
                        </p>
                    </div>

                    {{-- Tombol Konfirmasi --}}
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
                        ✅ Konfirmasi Pesanan
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection