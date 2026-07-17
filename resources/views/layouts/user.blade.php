<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SushiGo') — Pesan Sushi Online</title>
    <meta name="description" content="@yield('meta_description', 'SushiGo - Pesan sushi segar dan lezat secara online.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

{{-- ── Navbar ──────────────────────────────────────────── --}}
<nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center text-lg">🍣</div>
                <span class="font-bold text-xl text-gray-800">SushiGo</span>
            </a>

            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                   class="text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-red-600' : 'text-gray-600 hover:text-red-600' }}">
                    Beranda
                </a>
                <a href="{{ route('menu.index') }}"
                   class="text-sm font-medium transition-colors {{ request()->routeIs('menu.*') ? 'text-red-600' : 'text-gray-600 hover:text-red-600' }}">
                    Menu
                </a>
                @auth
                <a href="{{ route('orders.index') }}"
                   class="text-sm font-medium transition-colors {{ request()->routeIs('orders.*') ? 'text-red-600' : 'text-gray-600 hover:text-red-600' }}">
                    Pesanan Saya
                </a>
                @endauth
            </div>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">
                @auth
                    {{-- Ikon Keranjang --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-500 hover:text-red-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @php
                            $cartCount = auth()->user()->cart?->items()->count() ?? 0;
                        @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    {{-- Dropdown User --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-red-600 transition-colors">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <span class="text-red-600 font-bold text-xs">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <span class="hidden md:block max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-lg py-2 z-50">
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                🧾 Pesanan Saya
                            </a>
                            <<a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                👤 Edit Profil
                            </a>
                            <hr class="my-1 border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    🚪 Keluar
                                </button>
                            </form>
                        </div>
                    </div>

                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-gray-600 hover:text-red-600 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2 rounded-xl transition-colors">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- ── Main Content ──────────────────────────────────────── --}}
<main>
    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-5">
        <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-5">
        <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm flex items-center gap-2">
            ❌ {{ session('error') }}
        </div>
    </div>
    @endif

    @yield('content')
</main>

{{-- ── Footer ────────────────────────────────────────────── --}}
<footer class="bg-gray-900 text-white mt-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center text-lg">🍣</div>
                <span class="font-bold text-xl">SushiGo</span>
            </div>
            <p class="text-gray-400 text-sm text-center">
                © {{ date('Y') }} SushiGo. Semua hak dilindungi.
            </p>
            <div class="flex gap-6">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Beranda</a>
                <a href="{{ route('menu.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Menu</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>