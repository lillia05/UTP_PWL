@extends('layouts.dashboard')

@section('title', 'Detail Booking')

@section('content')
<div class="w-full px-6 md:px-8 lg:px-12">
    <div class="mb-6">
        <a href="{{ route('bansus.bookings.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Booking
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Detail Booking</h2>
            <div class="mt-3 text-gray-500 text-lg font-normal">Lihat informasi lengkap pemesanan laboratorium</div>
        </div>
        <div>
            @if($booking->status === 'pending')
                <span class="px-5 py-2 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800 shadow-sm">
                    Pending
                </span>
            @elseif($booking->status === 'approved')
                <span class="px-5 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800 shadow-sm">
                    Disetujui
                </span>
            @else
                <span class="px-5 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800 shadow-sm">
                    Ditolak
                </span>
            @endif
        </div>
    </div>

    <div class="bg-white shadow-md rounded-xl ring-1 ring-gray-200 p-8 space-y-8">
        {{-- Informasi Mahasiswa --}}
        <div>
            <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Mahasiswa</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <div class="text-gray-500 font-medium">Nama</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->user->name }}</div>
                </div>
                <div>
                    <div class="text-gray-500 font-medium">NIM</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->user->nim }}</div>
                </div>
                <div>
                    <div class="text-gray-500 font-medium">Email</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->user->email }}</div>
                </div>
                <div>
                    <div class="text-gray-500 font-medium">Jurusan</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->user->jurusan }}</div>
                </div>
            </div>
        </div>

        {{-- Informasi Booking --}}
        <div>
            <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Booking</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <div class="text-gray-500 font-medium">Ruangan</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->lab->nama ?? 'Lab Dihapus' }}</div>
                </div>
                <div>
                    <div class="text-gray-500 font-medium">Tanggal</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->tanggal->format('d/m/Y') }}</div>
                </div>
                <div>
                    <div class="text-gray-500 font-medium">Hari</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->hari }}</div>
                </div>
                <div>
                    <div class="text-gray-500 font-medium">Waktu</div>
                    <div class="text-gray-900 font-semibold mt-1">{{ $booking->waktu }}</div>
                </div>
            </div>
        </div>

        {{-- Keperluan --}}
        <div>
            <h4 class="text-lg font-bold text-gray-800 mb-3 border-b pb-2">Keperluan</h4>
            <p class="text-gray-900 text-sm leading-relaxed">{{ $booking->keperluan }}</p>
        </div>

        {{-- Catatan --}}
        @if($booking->catatan)
            <div>
                <h4 class="text-lg font-bold text-gray-800 mb-3 border-b pb-2">Catatan</h4>
                <p class="text-gray-900 text-sm leading-relaxed">{{ $booking->catatan }}</p>
            </div>
        @endif

        {{-- Tindakan Admin --}}
        @if($booking->status === 'pending')
            <div>
                <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tindakan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Form Setujui --}}
                    <form action="{{ route('bansus.bookings.approve', $booking) }}" method="POST" class="bg-green-50 p-5 rounded-lg border border-green-200 shadow-sm">
                        @csrf
                        @method('PATCH')
                        <label for="approve_catatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="catatan" id="approve_catatan" rows="2" maxlength="500"
                                  class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 text-sm mb-4"></textarea>
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md transition">
                            ✓ Setujui Booking
                        </button>
                    </form>

                    {{-- Form Tolak --}}
                    <form action="{{ route('bansus.bookings.reject', $booking) }}" method="POST" class="bg-red-50 p-5 rounded-lg border border-red-200 shadow-sm">
                        @csrf
                        @method('PATCH')
                        <label for="reject_catatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="catatan" id="reject_catatan" rows="2" maxlength="500" required
                                  class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 text-sm mb-4"></textarea>
                        <button type="submit" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md transition">
                            ✗ Tolak Booking
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div class="text-xs text-gray-500 pt-4 border-t">
            Dibuat pada: {{ $booking->created_at->format('d/m/Y H:i') }}
        </div>
    </div>
</div>
@endsection
