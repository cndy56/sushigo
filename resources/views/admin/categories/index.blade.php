@extends('layouts.admin')
@section('title', 'Kategori')
@section('header', 'Kelola Kategori')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $categories->count() }} kategori ditemukan</p>
    <a href="{{ route('admin.categories.create') }}"
       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Nama Kategori</th>
                <th class="px-6 py-4 text-left">Deskripsi</th>
                <th class="px-6 py-4 text-center">Jumlah Menu</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($categories as $i => $category)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $category->description ?? '-' }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-red-50 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $category->products_count }} menu
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium px-4 py-1.5 rounded-lg transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                              onsubmit="return confirm('Hapus kategori ini?')">
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
                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                    Belum ada kategori. <a href="{{ route('admin.categories.create') }}" class="text-red-500 underline">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection