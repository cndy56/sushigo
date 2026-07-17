@extends('layouts.admin')
@section('title', 'Pengguna')
@section('header', 'Kelola Pengguna')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Nama</th>
                <th class="px-6 py-4 text-left">Email</th>
                <th class="px-6 py-4 text-center">Role</th>
                <th class="px-6 py-4 text-left">Bergabung</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($users as $i => $user)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-red-100 rounded-full flex items-center justify-center">
                            <span class="text-red-600 font-semibold text-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <span class="font-medium text-gray-800">{{ $user->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4 text-center">
                    @if($user->role === 'admin')
                    <span class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">Admin</span>
                    @else
                    <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">User</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-center">
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                          onsubmit="return confirm('Hapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium px-4 py-1.5 rounded-lg transition-colors">
                            Hapus
                        </button>
                    </form>
                    @else
                    <span class="text-xs text-gray-300">Akun Anda</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection