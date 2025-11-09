@extends('layouts.dashboard')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="w-full px-6 md:px-8 lg:px-12">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-10 mt-4">
            <div class="">
                <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Selamat Datang,
                    {{ strtok(auth()->user()->name, ' ') }}!</h2>
                <div class="mt-3 text-gray-500 text-lg font-normal">Kelola pemesanan laboratorium Anda dengan mudah bersama
                    SiBookLab!.</div>
            </div>
            <div class="flex gap-3 flex-col md:flex-row items-start md:items-center pt-2">
                <a href="{{ route('mahasiswa.jadwal.index') }}"
                    class="inline-flex items-center px-7 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white text-base font-semibold shadow-md transition"><svg
                        class="w-5 h-5 mr-2 opacity-80" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 11h14M5 19h14a2 2 0 002-2V11a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                    </svg>Lihat Jadwal Terisi</a>
                <a href="{{ route('mahasiswa.booking.create') }}"
                    class="inline-flex items-center px-7 py-3 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold shadow-md transition"><svg
                        class="w-5 h-5 mr-1 opacity-80" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>Booking Baru</a>
            </div>
        </div>
        <div class="mb-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div
                class="flex items-center bg-blue-500 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl p-7 shadow-md border border-blue-300 min-w-[180px]">
                <div class="flex flex-col">
                    <span class="text-white text-base font-semibold flex gap-2 items-center"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v.01M15 17v.01M12 16v1a3 3 0 01-3 3H7a3 3 0 01-3-3V5a3 3 0 013-3h10a3 3 0 013 3v12a3 3 0 01-3 3h-2a3 3 0 01-3-3z" />
                        </svg> Total Booking</span>
                    <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['total'] }}</span>
                </div>
            </div>
            <div
                class="flex items-center bg-yellow-400 bg-gradient-to-br from-yellow-300 to-yellow-500 rounded-xl p-7 shadow-md border border-yellow-300 min-w-[180px]">
                <div class="flex flex-col">
                    <span class="text-white text-base font-semibold flex gap-2 items-center"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2" />
                        </svg> Pending</span>
                    <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['pending'] }}</span>
                </div>
            </div>
            <div
                class="flex items-center bg-green-500 bg-gradient-to-br from-green-400 to-green-600 rounded-xl p-7 shadow-md border border-green-300 min-w-[180px]">
                <div class="flex flex-col">
                    <span class="text-white text-base font-semibold flex gap-2 items-center"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg> Disetujui</span>
                    <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['approved'] }}</span>
                </div>
            </div>
            <div
                class="flex items-center bg-red-500 bg-gradient-to-br from-red-400 to-red-600 rounded-xl p-7 shadow-md border border-red-300 min-w-[180px]">
                <div class="flex flex-col">
                    <span class="text-white text-base font-semibold flex gap-2 items-center"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg> Ditolak</span>
                    <span class="text-4xl font-extrabold text-white pt-3">{{ $stats['rejected'] }}</span>
                </div>
            </div>
        </div>
        <div class="font-bold text-2xl text-gray-800 mb-4 mt-4">Riwayat Booking Terakhir</div>
        <div class="overflow-x-auto rounded-xl shadow-md ring-1 ring-gray-200">
            <table class="min-w-full bg-white rounded-xl">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">TANGGAL</th>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">RUANG</th>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">HARI</th>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">WAKTU</th>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">KEPERLUAN</th>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">STATUS</th>
                        <th class="text-xs text-gray-600 font-semibold uppercase px-6 py-4 text-left">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-5 whitespace-nowrap text-gray-800 font-semibold">
                                {{ $booking->tanggal->format('d/m/Y') }}</td>
                            <td class="px-6 py-5 whitespace-nowrap font-bold text-blue-700">
                                {{ $booking->lab->nama ?? 'Lab Dihapus' }}</td>
                            <td class="px-6 py-5 whitespace-nowrap text-gray-700">{{ $booking->hari }}</td>
                            <td class="px-6 py-5 whitespace-nowrap text-gray-700">{{ $booking->waktu }}</td>
                            <td class="px-6 py-5 text-gray-700">{{ Str::limit($booking->keperluan, 35) }}</td>
                            <td class="px-6 py-5">
                                @if ($booking->status === 'pending')
                                    <span
                                        class="px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($booking->status === 'approved')
                                    <span
                                        class="px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">Disetujui</span>
                                @else
                                    <span
                                        class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 flex gap-3">
                                <a href="{{ route('mahasiswa.booking.show', $booking) }}"
                                    class="text-blue-600 hover:text-blue-900 font-semibold">Detail</a>

                                @if ($booking->status === 'pending')
                                    <form action="{{ route('mahasiswa.booking.destroy', $booking) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus booking ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">Belum ada booking. <a
                                    href="{{ route('mahasiswa.booking.create') }}"
                                    class="text-blue-600 hover:text-blue-800">Buat booking pertama Anda!</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
