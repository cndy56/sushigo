@extends('layouts.user')
@section('title', 'Menu Sushi')
@section('meta_description', 'Lihat semua menu sushi pilihan kami. Berbagai jenis sushi segar tersedia.')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Menu Sushi</h1>
        <p class="text-gray-500 mt-1">Temukan menu sushi favorit Anda</p>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('menu.index') }}" class="mb-8">
        <div class="flex flex-col sm:flex-row gap-3">
            {{-- Search Input --}}
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ $searchQuery }}"
                       placeholder="Cari menu sushi..."
                       class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-400">
            </div>
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-medium px-8 py-3 rounded-xl transition-colors text-sm">
                Cari
            </button>
            @if($searchQuery || $selectedCategory)
            <a href="{{ route('menu.index') }}"
               class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-3 rounded-xl transition-colors text-sm text-center">
                Reset
            </a>
            @endif
        </div>
    </form>

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('menu.index', ['search' => $searchQuery]) }}"
           class="px-4 py-2 rounded-full text-sm font-medium transition-all
           {{ !$selectedCategory ? 'bg-red-600 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-red-300 hover:text-red-600' }}">
            Semua Menu
        </a>
        @foreach($categories as $category)
        <a href="{{ route('menu.index', ['category' => $category->slug, 'search' => $searchQuery]) }}"
           class="px-4 py-2 rounded-full text-sm font-medium transition-all
           {{ $selectedCategory === $category->slug ? 'bg-red-600 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-red-300 hover:text-red-600' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>

    {{-- Info Jumlah Hasil --}}
    <p class="text-sm text-gray-400 mb-6">
        Menampilkan <strong class="text-gray-700">{{ $products->count() }}</strong> menu
        @if($searchQuery) untuk "<strong class="text-gray-700">{{ $searchQuery }}</strong>" @endif
    </p>

    {{-- Grid Produk --}}
    @if($products->isEmpty())
    <div class="text-center py-20">
        <div class="text-6xl mb-4">🍣</div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Menu tidak ditemukan</h3>
        <p class="text-gray-400 text-sm mb-6">Coba kata kunci atau kategori lain.</p>
        <a href="{{ route('menu.index') }}" class="text-red-600 hover:underline text-sm">Lihat semua menu</a>
    </div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="{{ route('menu.show', $product->slug) }}"
           class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
            <div class="aspect-square bg-red-50 overflow-hidden">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center text-6xl">🍣</div>
                @endif
            </div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-medium bg-red-50 px-2 py-0.5 rounded-full">
                    {{ $product->category->name }}
                </span>
                <h2 class="font-semibold text-gray-800 mt-2 text-sm leading-snug group-hover:text-red-600 transition-colors">
                    {{ $product->name }}
                </h2>
                <div class="flex items-center justify-between mt-2">
                    <p class="text-red-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if($product->stock > 0)
                    <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Tersedia</span>
                    @else
                    <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">Habis</span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>

@endsection