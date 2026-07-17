@extends('layouts.user')
@section('title', 'Beranda')
@section('meta_description', 'SushiGo - Pesan sushi segar dan lezat secara online. Nikmati cita rasa Jepang di rumah Anda.')

@section('content')

{{-- ── Hero Section ─────────────────────────────────────── --}}
<section class="bg-gradient-to-br from-red-900 via-red-700 to-rose-600 text-white py-24 px-4 relative overflow-hidden">
    {{-- Dekorasi latar --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none select-none">
        <span class="absolute top-8 right-16 text-9xl">🍣</span>
        <span class="absolute bottom-8 left-16 text-8xl">🥢</span>
        <span class="absolute top-1/2 right-1/4 text-6xl -translate-y-1/2">🍱</span>
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <div class="max-w-2xl">
            <span class="inline-block bg-white/20 backdrop-blur text-white text-xs font-semibold px-4 py-2 rounded-full mb-6 tracking-widest uppercase">
                🍣 Sushi Autentik Jepang
            </span>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                Rasakan Kelezatan <br>
                <span class="text-rose-300">Sushi Segar</span>
            </h1>
            <p class="text-red-100 text-lg mb-10 leading-relaxed">
                Nikmati cita rasa sushi premium dari bahan-bahan segar pilihan.<br>
                Pesan sekarang dan rasakan pengalaman kuliner Jepang terbaik.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('menu.index') }}"
                   class="bg-white text-red-700 hover:bg-red-50 font-semibold px-8 py-3.5 rounded-xl transition-all shadow-lg hover:shadow-xl">
                    Lihat Menu
                </a>
                @auth
                <a href="{{ route('cart.index') }}"
                   class="border-2 border-white/40 hover:border-white text-white font-semibold px-8 py-3.5 rounded-xl transition-all">
                    Keranjang Saya
                </a>
                @else
                <a href="{{ route('register') }}"
                   class="border-2 border-white/40 hover:border-white text-white font-semibold px-8 py-3.5 rounded-xl transition-all">
                    Daftar Gratis
                </a>
                @endauth
            </div>
        </div>
    </div>
</section>

{{-- ── Kategori ──────────────────────────────────────────── --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Kategori Menu</h2>
        <p class="text-gray-500 mt-2">Pilih sesuai selera Anda</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('menu.index', ['category' => $category->slug]) }}"
           class="group bg-white border border-gray-100 hover:border-red-200 hover:bg-red-50 rounded-2xl p-5 text-center shadow-sm hover:shadow-md transition-all">
            <div class="text-4xl mb-3">🍣</div>
            <p class="font-semibold text-gray-800 group-hover:text-red-600 text-sm transition-colors">{{ $category->name }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $category->products_count }} menu</p>
        </a>
        @endforeach
    </div>
</section>

{{-- ── Menu Unggulan ────────────────────────────────────── --}}
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Menu Pilihan</h2>
                <p class="text-gray-500 mt-1">Paling disukai pelanggan kami</p>
            </div>
            <a href="{{ route('menu.index') }}"
               class="text-red-600 hover:text-red-700 font-semibold text-sm transition-colors">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
            <a href="{{ route('menu.show', $product->slug) }}"
               class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                {{-- Gambar Produk --}}
                <div class="aspect-square bg-red-50 overflow-hidden">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-6xl">🍣</div>
                    @endif
                </div>
                {{-- Info Produk --}}
                <div class="p-4">
                    <span class="text-xs text-red-500 font-medium bg-red-50 px-2 py-0.5 rounded-full">
                        {{ $product->category->name }}
                    </span>
                    <h3 class="font-semibold text-gray-800 mt-2 text-sm leading-snug group-hover:text-red-600 transition-colors">
                        {{ $product->name }}
                    </h3>
                    <p class="text-red-600 font-bold mt-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-10 text-gray-400">
                Belum ada menu tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ── Banner CTA ────────────────────────────────────────── --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-red-600 to-rose-500 rounded-3xl p-10 md:p-16 text-white text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Memesan Sushi?</h2>
        <p class="text-red-100 mb-8 text-lg">Daftar sekarang dan nikmati kemudahan pesan sushi online!</p>
        @guest
        <a href="{{ route('register') }}"
           class="bg-white text-red-600 hover:bg-red-50 font-bold px-10 py-3.5 rounded-xl transition-all shadow-lg">
            Daftar Sekarang
        </a>
        @else
        <a href="{{ route('menu.index') }}"
           class="bg-white text-red-600 hover:bg-red-50 font-bold px-10 py-3.5 rounded-xl transition-all shadow-lg">
            Pesan Sekarang
        </a>
        @endguest
    </div>
</section>

@endsection