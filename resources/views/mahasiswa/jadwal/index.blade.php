@extends('layouts.dashboard')

@section('title', 'Jadwal Laboratorium Terisi')

@section('content')
<div class="w-full px-6 md:px-8 lg:px-12">
    <div class="mb-6">
        <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Jadwal Terisi</h2>
            <div class="mt-3 text-gray-500 text-lg font-normal">Lihat jadwal laboratorium yang sudah dibooking</div>
        </div>
        <a href="{{ route('mahasiswa.booking.create') }}" class="inline-flex items-center px-7 py-3 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold shadow-md transition">
            <svg class="w-5 h-5 mr-1 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Booking Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl mb-8 p-6">
        <div class="font-bold text-xl text-gray-800 mb-4">Filter Jadwal</div>
        <form method="GET" action="{{ route('mahasiswa.jadwal.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div>
                <label for="lab_id" class="block text-sm font-semibold text-gray-700 mb-2">Ruangan</label>
                <select name="lab_id" id="lab_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Semua Ruangan</option>
                    @foreach($labs as $lab)
                        <option value="{{ $lab->id }}" {{ request('lab_id') == $lab->id ? 'selected' : '' }}>{{ $lab->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" min="{{ date('Y-m-d') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div class="flex items-end md:col-span-2">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Jadwal
                </button>
            </div>
        </form>
    </div>

    <div class="font-bold text-2xl text-gray-800 mb-4">Daftar Jadwal Terisi</div>
    <div class="overflow-x-auto rounded-xl shadow-md ring-1 ring-gray-200">
        <table class="min-w-full bg-white rounded-xl">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Ruangan</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Tanggal</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Waktu</th>
                    <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="px-4 py-2 text-sm font-bold rounded-lg bg-blue-100 text-blue-800">{{ $booking->lab->nama ?? 'Lab Dihapus' }}</span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-gray-800 font-semibold">{{ $booking->tanggal->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500 mt-1">{{ $booking->hari }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-gray-700 font-medium">{{ $booking->waktu }}</td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="px-4 py-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">Sudah Dibooking</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            <div class="text-lg font-medium">Tidak ada jadwal terisi yang ditemukan</div>
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