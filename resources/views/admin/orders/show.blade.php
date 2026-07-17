@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan')

@section('content')

<div class="max-w-2xl space-y-6">

    {{-- Info Pesanan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="font-mono font-bold text-lg text-gray-800">{{ $order->order_code }}</p>
                <p class="text-sm text-gray-400 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            @php
                $badge = match($order->status) {
                    'pending'    => 'bg-yellow-100 text-yellow-700',
                    'diproses'   => 'bg-blue-100 text-blue-700',
                    'selesai'    => 'bg-green-100 text-green-700',
                    'dibatalkan' => 'bg-red-100 text-red-600',
                    default      => 'bg-gray-100 text-gray-600',
                };
            @endphp
            <span class="px-3 py-1.5 rounded-full text-sm font-semibold {{ $badge }}">
                {{ $order->status_label }}
            </span>
        </div>
        <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Pelanggan</span>
                <span class="font-medium text-gray-800">{{ $order->user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Email</span>
                <span class="text-gray-800">{{ $order->user->email }}</span>
            </div>
            @if($order->notes)
            <div class="flex justify-between">
                <span class="text-gray-500">Catatan</span>
                <span class="text-gray-800">{{ $order->notes }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Daftar Item --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Item Pesanan</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($order->details as $detail)
            <div class="px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if($detail->product->image)
                    <img src="{{ asset('storage/' . $detail->product->image) }}" alt="{{ $detail->product->name }}"
                         class="w-12 h-12 object-cover rounded-xl">
                    @else
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-lg">🍣</div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $detail->product->name }}</p>
                        <p class="text-xs text-gray-400">Rp {{ number_format($detail->price, 0, ',', '.') }} × {{ $detail->quantity }}</p>
                    </div>
                </div>
                <p class="font-semibold text-gray-800">
                    Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
        <div class="px-6 py-4 bg-gray-50 flex justify-between font-bold text-gray-800">
            <span>Total</span>
            <span class="text-red-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-gray-800 mb-4">Ubah Status Pesanan</h3>
        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex gap-3">
            @csrf
            @method('PATCH')
            <select name="status"
                    class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300">
                <option value="pending"    {{ $order->status === 'pending'    ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses"   {{ $order->status === 'diproses'   ? 'selected' : '' }}>Diproses</option>
                <option value="selesai"    {{ $order->status === 'selesai'    ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition-colors text-sm">
                Perbarui
            </button>
        </form>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="inline-block text-sm text-gray-400 hover:text-gray-600">
        ← Kembali ke daftar pesanan
    </a>
</div>

@endsection