@extends('layouts.admin')
@section('title', 'Pesanan')
@section('header', 'Kelola Pesanan')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Kode Pesanan</th>
                <th class="px-6 py-4 text-left">Pelanggan</th>
                <th class="px-6 py-4 text-left">Total</th>
                <th class="px-6 py-4 text-center">Status</th>
                <th class="px-6 py-4 text-left">Tanggal</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-mono font-semibold text-gray-800">{{ $order->order_code }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $order->user->name }}</td>
                <td class="px-6 py-4 font-semibold text-gray-800">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-center">
                    @php
                        $badge = match($order->status) {
                            'pending'    => 'bg-yellow-100 text-yellow-700',
                            'diproses'   => 'bg-blue-100 text-blue-700',
                            'selesai'    => 'bg-green-100 text-green-700',
                            'dibatalkan' => 'bg-red-100 text-red-600',
                            default      => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $badge }}">
                        {{ $order->status_label }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">{{ $order->created_at->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.orders.show', $order) }}"
                       class="bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium px-4 py-1.5 rounded-lg transition-colors">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection