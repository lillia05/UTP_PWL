@extends('layouts.dashboard')

@section('title', 'Kelola User')

@section('content')
<div class="w-full px-6 md:px-8 lg:px-12">
    <div class="mb-6">
        <a href="{{ route('bansus.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Kelola User</h2>
            <div class="mt-3 text-gray-500 text-lg font-normal">Kelola semua akun mahasiswa dan bansus</div>
        </div>
        <a href="{{ route('bansus.users.create') }}" class="inline-flex items-center px-7 py-3 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold shadow-md transition">
            <svg class="w-5 h-5 mr-1 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah User
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-7 rounded-xl shadow-md border border-blue-500">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <div class="text-white text-base font-semibold">Total User</div>
            </div>
            <div class="text-4xl font-extrabold text-white">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-yellow-400 bg-gradient-to-br from-yellow-300 to-yellow-500 p-7 rounded-xl shadow-md border bg-yellow-400">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                </svg>
                <div class="text-white text-base font-semibold">Mahasiswa</div>
            </div>
            <div class="text-4xl font-extrabold text-white">{{ $stats['mahasiswa'] }}</div>
        </div>
        <div class="bg-green-500 bg-gradient-to-br from-green-400 to-green-600 p-7 rounded-xl shadow-md border bg-green-500">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                <div class="text-white text-base font-semibold">Bansus</div>
            </div>
            <div class="text-4xl font-extrabold text-white">{{ $stats['bansus'] }}</div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-xl mb-8 p-6">
        <div class="font-bold text-xl text-gray-800 mb-4">Filter User</div>
        <form method="GET" action="{{ route('bansus.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Cari</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        value="{{ request('search') }}"
                        placeholder="Nama, Email, atau NIM"
                        class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >
                </div>
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <select name="role" id="role" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Semua Role</option>
                    <option value="mahasiswa" {{ request('role') === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="bansus" {{ request('role') === 'bansus' ? 'selected' : '' }}>Bansus</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition">
                    Filter
                </button>
                <a href="{{ route('bansus.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-lg transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="font-bold text-2xl text-gray-800 mb-4">Daftar User</div>
    <div class="overflow-x-auto rounded-xl shadow-md ring-1 ring-gray-200">
        <table class="min-w-full bg-white rounded-xl">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Nama</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Email</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">NIM</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Jurusan</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Role</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Terdaftar</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-700">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-700 font-medium">{{ $user->nim ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-700">{{ $user->jurusan ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @if($user->role === 'mahasiswa')
                                <span class="px-4 py-2 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Mahasiswa
                                </span>
                            @else
                                <span class="px-4 py-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Bansus
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('bansus.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 font-semibold text-sm">
                                    Edit
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('bansus.users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="text-red-600 hover:text-red-900 font-semibold text-sm" 
                                            onclick="return confirm('Yakin ingin menghapus user ini? Semua booking user ini akan ikut terhapus.')"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm font-medium cursor-not-allowed">(Anda)</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <div class="text-lg font-medium">Tidak ada user ditemukan</div>
                            <div class="text-sm mt-2">Coba ubah filter pencarian Anda</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection