@extends('layouts.user')
@section('title', $product->name)
@section('meta_description', $product->description ?? 'Detail menu ' . $product->name . ' di SushiGo')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('menu.index') }}" class="hover:text-red-600 transition-colors">Menu</a>
        <span>/</span>
        <span class="text-gray-700 font-medium">{{ $product->name }}</span>
    </nav>

    {{-- Detail Produk --}}
    <div class="grid md:grid-cols-2 gap-12 mb-16">

        {{-- Gambar --}}
        <div class="aspect-square bg-red-50 rounded-3xl overflow-hidden">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                 class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center text-9xl">🍣</div>
            @endif
        </div>

        {{-- Info --}}
        <div class="flex flex-col justify-center">
            <span class="inline-block text-xs text-red-500 font-semibold bg-red-50 px-3 py-1 rounded-full mb-4 w-fit">
                {{ $product->category->name }}
            </span>

            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

            @if($product->description)
            <p class="text-gray-500 leading-relaxed mb-6">{{ $product->description }}</p>
            @endif

            <div class="flex items-center gap-4 mb-6">
                <p class="text-4xl font-bold text-red-600">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                @if($product->stock > 0)
                <span class="text-sm text-green-600 bg-green-50 border border-green-200 px-3 py-1 rounded-full font-medium">
                    ✅ Stok: {{ $product->stock }}
                </span>
                @else
                <span class="text-sm text-red-500 bg-red-50 border border-red-200 px-3 py-1 rounded-full font-medium">
                    ❌ Stok habis
                </span>
                @endif
            </div>

            {{-- Form Tambah ke Keranjang --}}
            @auth
                @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="flex items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               class="w-24 border border-gray-200 rounded-xl px-4 py-2 text-center text-sm focus:outline-none focus:ring-2 focus:ring-red-300">
                    </div>

                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-4 rounded-2xl transition-all shadow-md hover:shadow-lg text-center">
                        🛒 Tambah ke Keranjang
                    </button>
                </form>
                @else
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 text-center text-gray-500 text-sm">
                    Menu ini sedang tidak tersedia.
                </div>
                @endif
            @else
            <a href="{{ route('login') }}"
               class="block bg-red-600 hover:bg-red-700 text-white font-semibold py-4 rounded-2xl transition-all text-center shadow-md">
                🔐 Masuk untuk Memesan
            </a>
            @endauth
        </div>
    </div>

    {{-- Menu Terkait --}}
    @if($related->isNotEmpty())
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Menu Terkait</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($related as $item)
            <a href="{{ route('menu.show', $item->slug) }}"
               class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                <div class="aspect-square bg-red-50 overflow-hidden">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-5xl">🍣</div>
                    @endif
                </div>
                <div class="p-4">
                    <p class="font-semibold text-gray-800 text-sm group-hover:text-red-600 transition-colors">{{ $item->name }}</p>
                    <p class="text-red-600 font-bold mt-1 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

@endsection