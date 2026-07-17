@extends('layouts.admin')
@use('Illuminate\Support\Str')
@section('title', 'Menu Sushi')
@section('header', 'Kelola Menu Sushi')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $products->count() }} menu ditemukan</p>
    <a href="{{ route('admin.products.create') }}"
       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
        + Tambah Menu
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Menu</th>
                <th class="px-6 py-4 text-left">Kategori</th>
                <th class="px-6 py-4 text-left">Harga</th>
                <th class="px-6 py-4 text-center">Stok</th>
                <th class="px-6 py-4 text-center">Status</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                             class="w-12 h-12 object-cover rounded-xl">
                        @else
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-xl">🍣</div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($product->description, 40) }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $product->category->name }}</td>
                <td class="px-6 py-4 font-semibold text-gray-800">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-center text-gray-600">{{ $product->stock }}</td>
                <td class="px-6 py-4 text-center">
                    @if($product->is_available)
                    <span class="bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full">Tersedia</span>
                    @else
                    <span class="bg-gray-100 text-gray-500 text-xs font-medium px-3 py-1 rounded-full">Tidak Tersedia</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium px-4 py-1.5 rounded-lg transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium px-4 py-1.5 rounded-lg transition-colors">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                    Belum ada menu. <a href="{{ route('admin.products.create') }}" class="text-red-500 underline">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection