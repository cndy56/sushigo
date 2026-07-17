@extends('layouts.user')
@section('title', 'Edit Profil')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">👤 Edit Profil</h1>

    {{-- ── Informasi Akun ────────────────────────────── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Informasi Akun</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Nama --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 @error('name') border-red-400 @enderror">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 @error('email') border-red-400 @enderror">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor Telepon --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       placeholder="Contoh: 08123456789"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300">
            </div>

            {{-- Alamat --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                <textarea name="address" rows="3"
                          placeholder="Contoh: Jl. Mawar No. 10, Jakarta Selatan"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 resize-none">{{ old('address', $user->address) }}</textarea>
            </div>

            {{-- Alert sukses --}}
            @if(session('status') === 'profile-updated')
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                ✅ Profil berhasil diperbarui!
            </div>
            @endif

            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-xl transition-colors">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- ── Ubah Password ─────────────────────────────── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Ubah Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            {{-- Password Lama --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                <input type="password" name="current_password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 @error('current_password', 'updatePassword') border-red-400 @enderror">
                @error('current_password', 'updatePassword')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Baru --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                <input type="password" name="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 @error('password', 'updatePassword') border-red-400 @enderror">
                @error('password', 'updatePassword')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300">
            </div>

            @if(session('status') === 'password-updated')
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                ✅ Password berhasil diperbarui!
            </div>
            @endif

            <button type="submit"
                class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-8 py-3 rounded-xl transition-colors">
                Ubah Password
            </button>
        </form>
    </div>

    {{-- ── Hapus Akun ────────────────────────────────── --}}
    <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-8">
        <h2 class="text-lg font-semibold text-red-600 mb-2">Zona Berbahaya</h2>
        <p class="text-sm text-gray-500 mb-5">
            Setelah akun dihapus, semua data akan hilang permanen.
        </p>
        <button onclick="document.getElementById('modal-hapus').classList.remove('hidden')"
                class="border border-red-300 text-red-600 hover:bg-red-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">
            Hapus Akun Saya
        </button>
    </div>

    {{-- Modal Konfirmasi Hapus Akun --}}
    <div id="modal-hapus" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl">
            <h3 class="text-xl font-bold text-gray-800 mb-3">Hapus Akun?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Masukkan password Anda untuk mengkonfirmasi penghapusan akun secara permanen.
            </p>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <input type="password" name="password" placeholder="Password Anda"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-300 mb-4">
                @error('password', 'userDeletion')
                <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
                @enderror
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition-colors text-sm">
                        Ya, Hapus Akun
                    </button>
                    <button type="button"
                            onclick="document.getElementById('modal-hapus').classList.add('hidden')"
                            class="flex-1 border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium py-3 rounded-xl transition-colors text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection