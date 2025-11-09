@extends('layouts.dashboard')

@section('title', 'Kelola Booking')

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
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Kelola Booking</h2>
            <div class="mt-3 text-gray-500 text-lg font-normal">Kelola dan verifikasi semua booking laboratorium</div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-xl mb-8 p-6">
        <div class="font-bold text-xl text-gray-800 mb-4">Filter Booking</div>
        <form method="GET" action="{{ route('bansus.bookings.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-5">
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div>
                <label for="lab_id" class="block text-sm font-semibold text-gray-700 mb-2">Ruangan</label>
                <select name="lab_id" id="lab_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Semua Ruangan</option>
                    @foreach($labs as $lab)
                        <option value="{{ $lab->id }}" {{ request('lab_id') == $lab->id ? 'selected' : '' }}>
                            {{ $lab->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <div class="flex items-end md:col-span-2">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Booking
                </button>
            </div>
        </form>
    </div>

    <div class="font-bold text-2xl text-gray-800 mb-4">Daftar Booking</div>
    <div class="overflow-x-auto rounded-xl shadow-md ring-1 ring-gray-200">
        <table class="min-w-full bg-white rounded-xl">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Mahasiswa</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Ruangan</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Tanggal</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Waktu</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Keperluan</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Status</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $booking->user->name }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $booking->user->nim }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="px-4 py-2 text-sm font-bold rounded-lg bg-blue-100 text-blue-800">
                                {{ $booking->lab->nama ?? 'Lab Dihapus' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-gray-800 font-semibold">{{ $booking->tanggal->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500 mt-1">{{ $booking->hari }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-gray-700 font-medium">
                            {{ $booking->waktu }}
                        </td>
                        <td class="px-6 py-5 text-gray-700">
                            {{ Str::limit($booking->keperluan, 50) }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @if($booking->status === 'pending')
                                <span class="px-4 py-2 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($booking->status === 'approved')
                                <span class="px-4 py-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @else
                                <span class="px-4 py-2 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('bansus.bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-900 font-semibold text-sm">
                                    Detail
                                </a>
                                <form action="{{ route('bansus.bookings.destroy', $booking) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v.01M15 17v.01M12 16v1a3 3 0 01-3 3H7a3 3 0 01-3-3V5a3 3 0 013-3h10a3 3 0 013 3v12a3 3 0 01-3 3h-2a3 3 0 01-3-3z"/>
                            </svg>
                            <div class="text-lg font-medium">Tidak ada booking ditemukan</div>
                            <div class="text-sm mt-2">Coba ubah filter pencarian Anda</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($bookings->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $bookings->links() }}
        </div>
    @endif
</div>
@endsection