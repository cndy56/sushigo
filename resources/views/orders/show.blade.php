@extends('layouts.user')
@section('title', 'Detail Pesanan ' . $order->order_code)

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('orders.index') }}" class="hover:text-red-600 transition-colors">Pesanan Saya</a>
        <span>/</span>
        <span class="text-gray-700 font-medium font-mono">{{ $order->order_code }}</span>
    </nav>

    {{-- Header Status --}}
    @php
        $badge = match($order->status) {
            'pending'    => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'diproses'   => 'bg-blue-100 text-blue-700 border-blue-200',
            'selesai'    => 'bg-green-100 text-green-700 border-green-200',
            'dibatalkan' => 'bg-red-100 text-red-600 border-red-200',
            default      => 'bg-gray-100 text-gray-600 border-gray-200',
        };
        $icon = match($order->status) {
            'pending'    => '⏳',
            'diproses'   => '👨‍🍳',
            'selesai'    => '✅',
            'dibatalkan' => '❌',
            default      => '📋',
        };
    @endphp

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-sm text-gray-400 mb-1">Kode Pesanan</p>
                <h1 class="text-2xl font-bold font-mono text-gray-800">{{ $order->order_code }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold border {{ $badge }} w-fit">
                {{ $icon }} {{ $order->status_label }}
            </span>
        </div>

        @if($order->notes)
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-400 mb-1">Catatan:</p>
            <p class="text-sm text-gray-700">{{ $order->notes }}</p>
        </div>
        @endif
    </div>

    {{-- Daftar Item --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">Item Pesanan</h2>
        </div>

        <div class="divide-y divide-gray-50">
            @foreach($order->details as $detail)
            <div class="px-6 py-4 flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-red-50 rounded-xl overflow-hidden flex-shrink-0">
                        @if($detail->product->image)
                        <img src="{{ asset('storage/' . $detail->product->image) }}"
                             alt="{{ $detail->product->name }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-2xl">🍣</div>
                        @endif
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 text-sm">{{ $detail->product->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Rp {{ number_format($detail->price, 0, ',', '.') }} × {{ $detail->quantity }}
                        </p>
                    </div>
                </div>
                <p class="font-bold text-gray-800 flex-shrink-0">
                    Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="px-6 py-4 bg-red-50 flex justify-between items-center">
            <span class="font-bold text-gray-800">Total Pembayaran</span>
            <span class="font-bold text-red-600 text-xl">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('orders.index') }}"
           class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-3 rounded-xl transition-colors text-sm">
            ← Riwayat Pesanan
        </a>

        @if($order->status === 'pending')
        <form action="{{ route('orders.cancel', $order->order_code) }}" method="POST"
              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
            @csrf
            @method('PATCH')
            <button type="submit"
                class="border border-red-200 text-red-500 hover:bg-red-50 font-medium px-6 py-3 rounded-xl transition-colors text-sm">
                Batalkan Pesanan
            </button>
        </form>
        @endif

        @if($order->status === 'selesai')
        <a href="{{ route('menu.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-xl transition-colors text-sm">
            Pesan Lagi
        </a>
        @endif
    </div>

    {{-- Info Progress Status --}}
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-700 mb-5">Progress Pesanan</h3>
        @php
            $steps = [
                ['key' => 'pending',    'label' => 'Pesanan Masuk',   'icon' => '📋'],
                ['key' => 'diproses',   'label' => 'Sedang Diproses', 'icon' => '👨‍🍳'],
                ['key' => 'selesai',    'label' => 'Selesai',         'icon' => '✅'],
            ];
            $statusOrder = ['pending' => 0, 'diproses' => 1, 'selesai' => 2, 'dibatalkan' => -1];
            $currentStep = $statusOrder[$order->status] ?? 0;
        @endphp

        @if($order->status === 'dibatalkan')
        <div class="flex items-center gap-3 text-red-500">
            <span class="text-2xl">❌</span>
            <span class="font-medium">Pesanan ini telah dibatalkan.</span>
        </div>
        @else
        <div class="flex items-center gap-2">
            @foreach($steps as $i => $step)
            <div class="flex items-center gap-2 flex-1">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg
                        {{ $i <= $currentStep ? 'bg-red-600 shadow-md' : 'bg-gray-100' }}">
                        {{ $step['icon'] }}
                    </div>
                    <p class="text-xs mt-2 text-center font-medium
                        {{ $i <= $currentStep ? 'text-red-600' : 'text-gray-400' }}">
                        {{ $step['label'] }}
                    </p>
                </div>
                @if(!$loop->last)
                <div class="flex-1 h-0.5 mb-5 {{ $i < $currentStep ? 'bg-red-400' : 'bg-gray-200' }}"></div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>

@endsection