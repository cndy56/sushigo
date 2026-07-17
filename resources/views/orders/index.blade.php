@extends('layouts.user')
@section('title', 'Riwayat Pesanan')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">🧾 Pesanan Saya</h1>
        <p class="text-gray-500 mt-1">Riwayat semua pesanan Anda di SushiGo.</p>
    </div>

    @if($orders->isEmpty())
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-16 text-center">
        <div class="text-7xl mb-5">📋</div>
        <h2 class="text-2xl font-bold text-gray-700 mb-3">Belum ada pesanan</h2>
        <p class="text-gray-400 mb-8">Yuk, mulai pesan sushi favorit Anda!</p>
        <a href="{{ route('menu.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white font-semibold px-10 py-3.5 rounded-xl transition-all inline-block">
            Lihat Menu
        </a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($orders as $order)
        @php
            $badge = match($order->status) {
                'pending'    => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                'diproses'   => 'bg-blue-100 text-blue-700 border-blue-200',
                'selesai'    => 'bg-green-100 text-green-700 border-green-200',
                'dibatalkan' => 'bg-red-100 text-red-600 border-red-200',
                default      => 'bg-gray-100 text-gray-600 border-gray-200',
            };
        @endphp
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6
                    hover:shadow-md transition-all">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                {{-- Info Pesanan --}}
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <p class="font-mono font-bold text-gray-800">{{ $order->order_code }}</p>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $badge }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    <p class="text-sm font-bold text-red-600 mt-2">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Aksi --}}
                <div class="flex items-center gap-3 flex-shrink-0">
                    <a href="{{ route('orders.show', $order->order_code) }}"
                       class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
                        Lihat Detail
                    </a>
                    @if($order->status === 'pending')
                    <form action="{{ route('orders.cancel', $order->order_code) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="border border-red-200 text-red-500 hover:bg-red-50 text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
                            Batalkan
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>

@endsection