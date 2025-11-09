@extends('layouts.dashboard')

@section('title', 'Dashboard Bansus')

@section('content')
<div class="w-full px-6 md:px-8 lg:px-12">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-10 mt-4">
        <div class="">
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Selamat Datang, Bansus!</h2>
            <div class="mt-3 text-gray-500 text-lg font-normal">Kelola pemesanan laboratorium dengan mudah dan efisien.</div>
        </div>
        <div class="flex gap-3 flex-col md:flex-row items-start md:items-center pt-2">
            <a href="{{ route('bansus.bookings.index') }}" class="inline-flex items-center px-7 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white text-base font-semibold shadow-md transition">
                <svg class="w-5 h-5 mr-2 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Lihat Semua Booking
            </a>
        </div>
    </div>
    
    <div class="mb-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="flex items-center bg-blue-500 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl p-7 shadow-md border border-blue-300 min-w-[180px]">
            <div class="flex flex-col">
                <span class="text-white text-base font-semibold flex gap-2 items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v.01M15 17v.01M12 16v1a3 3 0 01-3 3H7a3 3 0 01-3-3V5a3 3 0 013-3h10a3 3 0 013 3v12a3 3 0 01-3 3h-2a3 3 0 01-3-3z"/>
                    </svg> 
                    Total Booking
                </span>
                <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['total'] }}</span>
            </div>
        </div>
        <div class="flex items-center bg-yellow-400 bg-gradient-to-br from-yellow-300 to-yellow-500 rounded-xl p-7 shadow-md border border-yellow-300 min-w-[180px]">
            <div class="flex flex-col">
                <span class="text-white text-base font-semibold flex gap-2 items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                    </svg> 
                    Pending
                </span>
                <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['pending'] }}</span>
            </div>
        </div>
        <div class="flex items-center bg-green-500 bg-gradient-to-br from-green-400 to-green-600 rounded-xl p-7 shadow-md border border-green-300 min-w-[180px]">
            <div class="flex flex-col">
                <span class="text-white text-base font-semibold flex gap-2 items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg> 
                    Disetujui
                </span>
                <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['approved'] }}</span>
            </div>
        </div>
        <div class="flex items-center bg-red-500 bg-gradient-to-br from-red-400 to-red-600 rounded-xl p-7 shadow-md border border-red-300 min-w-[180px]">
            <div class="flex flex-col">
                <span class="text-white text-base font-semibold flex gap-2 items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg> 
                    Ditolak
                </span>
                <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['rejected'] }}</span>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-md ring-1 ring-gray-200">
            <div class="font-bold text-2xl text-gray-800 px-8 pt-6 pb-4 border-b border-gray-100">Booking Terbaru</div>
            <div class="divide-y divide-gray-100">
                @forelse($recentBookings as $booking)
                    <div class="flex justify-between px-8 py-5 items-start hover:bg-gray-50 transition">
                        <div class="flex-1">
                            <div class="flex gap-2 items-center mb-2 flex-wrap">
                                <span class="px-3 py-1.5 rounded-lg text-xs bg-blue-100 text-blue-700 font-bold">{{ $booking->lab->nama ?? 'Lab Dihapus' }}</span>
                                @if($booking->status === 'pending')
                                    <span class="px-3 py-1.5 rounded-full text-xs bg-yellow-100 text-yellow-800 font-semibold">Pending</span>
                                @elseif($booking->status === 'approved')
                                    <span class="px-3 py-1.5 rounded-full text-xs bg-green-100 text-green-800 font-semibold">Disetujui</span>
                                @else
                                    <span class="px-3 py-1.5 rounded-full text-xs bg-red-100 text-red-800 font-semibold">Ditolak</span>
                                @endif
                            </div>
                            <div class="font-semibold text-base text-gray-900 mb-1">{{ $booking->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $booking->tanggal->format('d/m/Y') }} · {{ $booking->waktu }}</div>
                        </div>
                        <a href="{{ route('bansus.bookings.show', $booking) }}" class="text-blue-600 font-semibold hover:text-blue-800 text-sm ml-4 whitespace-nowrap">Lihat Detail</a>
                    </div>
                @empty
                    <div class="px-8 py-10 text-center text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v.01M15 17v.01M12 16v1a3 3 0 01-3 3H7a3 3 0 01-3-3V5a3 3 0 013-3h10a3 3 0 013 3v12a3 3 0 01-3 3h-2a3 3 0 01-3-3z"/>
                        </svg>
                        <div class="text-lg font-medium">Belum ada booking</div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md ring-1 ring-gray-200">
            <div class="px-8 pt-6 pb-2 border-b border-gray-100">
                <div class="font-bold text-2xl text-gray-800 mb-2">Jadwal Hari Ini</div>
                <div class="text-sm text-gray-500 pb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ now()->format('l, d F Y') }}
                </div>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($todayBookings as $booking)
                    <div class="flex justify-between px-8 py-5 items-start hover:bg-gray-50 transition">
                        <div class="flex-1">
                            <div class="flex gap-2 items-center mb-2 flex-wrap">
                                <span class="px-3 py-1.5 rounded-lg text-xs bg-blue-100 text-blue-700 font-bold">{{ $booking->lab->nama ?? 'Lab Dihapus' }}</span>
                                <span class="text-xs text-gray-600 font-medium">{{ $booking->waktu }}</span>
                            </div>
                            <div class="font-semibold text-base text-gray-900 mb-1">{{ $booking->user->name }}</div>
                            <p class="text-sm text-gray-500 mb-2">{{ Str::limit($booking->keperluan, 60) }}</p>
                            @if($booking->status === 'pending')
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 inline-block">Pending</span>
                            @elseif($booking->status === 'approved')
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 inline-block">Disetujui</span>
                            @else
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 inline-block">Ditolak</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="px-8 py-10 text-center text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div class="text-lg font-medium">Tidak ada jadwal hari ini</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection