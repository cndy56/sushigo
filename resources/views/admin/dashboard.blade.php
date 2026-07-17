@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')

{{-- Kartu Statistik --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @php
        $stats = [
            ['label' => 'Total Menu',     'value' => $totalProducts,   'color' => 'bg-red-50 text-red-600'],
            ['label' => 'Total Kategori', 'value' => $totalCategories, 'color' => 'bg-orange-50 text-orange-500'],
            ['label' => 'Total Pesanan',  'value' => $totalOrders,     'color' => 'bg-blue-50 text-blue-500'],
            ['label' => 'Total Pengguna', 'value' => $totalUsers,      'color' => 'bg-green-50 text-green-500'],
        ];
    @endphp

    @foreach($stats as $stat)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <p class="text-4xl font-bold text-gray-800 mb-1">{{ $stat['value'] }}</p>
        <p class="text-sm text-gray-400">{{ $stat['label'] }}</p>
    </div>
    @endforeach
</div>

{{-- Pesanan Terbaru --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-semibold text-gray-800">Pesanan Terbaru</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-red-500 hover:underline">Lihat semua →</a>
    </div>
    <div class="divide-y divide-gray-50">
        @forelse($recentOrders as $order)
        <div class="px-6 py-4 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-800">{{ $order->order_code }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $order->user->name }} · {{ $order->created_at->diffForHumans() }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                @php
                    $badge = match($order->status) {
                        'pending'    => 'bg-yellow-100 text-yellow-700',
                        'diproses'   => 'bg-blue-100 text-blue-700',
                        'selesai'    => 'bg-green-100 text-green-700',
                        'dibatalkan' => 'bg-red-100 text-red-600',
                        default      => 'bg-gray-100 text-gray-600',
                    };
                @endphp
                <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>
        @empty
        <p class="px-6 py-8 text-center text-gray-400 text-sm">Belum ada pesanan.</p>
        @endforelse
    </div>
</div>

@endsection