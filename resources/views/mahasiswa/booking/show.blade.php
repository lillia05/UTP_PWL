@extends('layouts.dashboard')

@section('title', 'Detail Booking')

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

    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Detail Booking</h2>
        <div class="mt-3 text-gray-500 text-lg font-normal">Informasi lengkap booking laboratorium Anda</div>
    </div>

    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl">
        <div class="px-8 py-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-900">Informasi Booking</h3>
            @if($booking->status === 'pending')
                <span class="px-4 py-2 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                    </svg>
                    Pending
                </span>
            @elseif($booking->status === 'approved')
                <span class="px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Disetujui
                </span>
            @else
                <span class="px-4 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Ditolak
                </span>
            @endif
        </div>

        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                    <div class="text-sm font-semibold text-gray-500 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Ruangan
                    </div>
                    <div class="text-base text-gray-900 font-bold">{{ $booking->lab->nama ?? 'Lab Dihapus' }}</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                    <div class="text-sm font-semibold text-gray-500 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Tanggal
                    </div>
                    <div class="text-base text-gray-900 font-bold">{{ $booking->tanggal->format('d/m/Y') }}</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                    <div class="text-sm font-semibold text-gray-500 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Hari
                    </div>
                    <div class="text-base text-gray-900 font-bold">{{ $booking->hari }}</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                    <div class="text-sm font-semibold text-gray-500 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                        </svg>
                        Waktu
                    </div>
                    <div class="text-base text-gray-900 font-bold">{{ $booking->waktu }}</div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                <div class="text-sm font-semibold text-gray-500 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Keperluan
                </div>
                <div class="text-base text-gray-900 leading-relaxed">{{ $booking->keperluan }}</div>
            </div>

            @if($booking->catatan)
                <div class="bg-blue-50 rounded-lg p-5 border-2 border-blue-200">
                    <div class="text-sm font-semibold text-blue-700 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Catatan dari Bansus
                    </div>
                    <div class="text-base text-blue-900 leading-relaxed">{{ $booking->catatan }}</div>
                </div>
            @endif

            <div class="border-t pt-5 flex items-center gap-2 text-sm text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Dibuat pada: {{ $booking->created_at->format('d/m/Y H:i') }}
            </div>
        </div>
    </div>
</div>
@endsection