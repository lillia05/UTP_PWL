@extends('layouts.dashboard')

@section('title', 'Edit Booking')

@section('content')
    <div class="w-full px-6 md:px-8 lg:px-12">
        <div class="mb-6">
            <a href="{{ route('mahasiswa.dashboard') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-base transition">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <div class="mb-8 text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-0">Edit Booking</h2>
            <div class="mt-3 text-gray-500 text-lg font-normal">Perbarui data booking laboratorium Anda</div>
        </div>

        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl">
            <div class="px-8 py-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Form Edit Booking</h3>
            </div>

            <form method="POST" action="{{ route('mahasiswa.booking.update', $booking) }}" class="p-8 space-y-7"
                id="booking-form" novalidate>
                @csrf
                @method('PATCH')

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-blue-800">
                            Hanya booking dengan status <strong>pending</strong> yang bisa diedit
                        </p>
                    </div>
                </div>

                <div>
                    <label for="lab_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Ruangan <span class="text-red-500">*</span>
                    </label>
                    <select name="lab_id" id="lab_id" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}"
                                {{ old('lab_id', $booking->lab_id) == $lab->id ? 'selected' : '' }}>
                                {{ $lab->nama }} (Kapasitas: {{ $lab->kapasitas }} orang)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" id="tanggal"
                        value="{{ old('tanggal', $booking->tanggal->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}"
                        max="{{ date('Y-m-d', strtotime('+10 years')) }}"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="mt-2 text-sm text-gray-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Hanya hari Senin - Jumat
                    </p>
                </div>

                <div>
                    <label for="waktu" class="block text-sm font-semibold text-gray-700 mb-2">
                        Waktu <span class="text-red-500">*</span>
                    </label>
                    <select name="waktu" id="waktu" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">-- Pilih Waktu --</option>
                        @foreach ($waktu as $w)
                            <option value="{{ $w }}"
                                {{ old('waktu', $booking->waktu) === $w ? 'selected' : '' }}>{{ $w }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="keperluan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Keperluan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keperluan" id="keperluan" rows="5" required maxlength="500"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none">{{ old('keperluan', $booking->keperluan) }}</textarea>
                    <p class="mt-2 text-sm text-gray-500 flex justify-between">
                        <span>Maksimal 500 karakter</span>
                        <span><span id="char-count">{{ strlen(old('keperluan', $booking->keperluan)) }}</span>/500</span>
                    </p>
                </div>

                <div id="availability-message" class="hidden p-4 rounded-lg font-medium"></div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('mahasiswa.dashboard') }}"
                        class="px-6 py-3 border-2 border-gray-300 rounded-lg text-base font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-7 py-3 rounded-lg shadow-md text-base font-semibold text-white bg-blue-500 hover:bg-blue-600 transition inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Booking
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-4xl mx-auto mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-sm text-yellow-700 font-medium mb-1">Catatan:</p>
            <ul class="list-disc list-inside text-sm text-yellow-700 space-y-1">
                <li>Setelah diedit, status booking kembali menjadi <strong>pending</strong></li>
                <li>Booking yang sudah <strong>approved</strong> atau <strong>rejected</strong> tidak bisa diubah</li>
                <li>Pastikan ruangan tersedia pada waktu yang dipilih</li>
            </ul>
        </div>
    </div>

    <script>
        const keperluan = document.getElementById('keperluan');
        const charCount = document.getElementById('char-count');
        keperluan.addEventListener('input', () => charCount.textContent = keperluan.value.length);

        const labSelect = document.getElementById('lab_id');
        const tanggalInput = document.getElementById('tanggal');
        const waktuSelect = document.getElementById('waktu');
        const availabilityMessage = document.getElementById('availability-message');
        const bookingId = {{ $booking->id }};

        function checkAvailability() {
            const lab_id = labSelect.value;
            const tanggal = tanggalInput.value;
            const waktu = waktuSelect.value;

            if (lab_id && tanggal && waktu) {
                fetch(
                        `{{ route('mahasiswa.booking.check') }}?lab_id=${lab_id}&tanggal=${tanggal}&waktu=${waktu}&booking_id=${bookingId}`)
                    .then(res => res.json())
                    .then(data => {
                        availabilityMessage.classList.remove('hidden');
                        if (data.available) {
                            availabilityMessage.className =
                                'p-4 rounded-lg bg-green-50 border-2 border-green-200 text-green-700 font-medium flex items-center gap-2';
                            availabilityMessage.innerHTML =
                                '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Ruangan tersedia!';
                        } else {
                            availabilityMessage.className =
                                'p-4 rounded-lg bg-red-50 border-2 border-red-200 text-red-700 font-medium flex items-center gap-2';
                            availabilityMessage.innerHTML =
                                '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Ruangan sudah dibooking pada waktu tersebut.';
                        }
                    });
            }
        }

        // Validasi agar hanya hari Senin–Jumat yang bisa dipilih
        tanggalInput.addEventListener('change', () => {
            const date = new Date(tanggalInput.value);
            const day = date.getDay(); // 0 = Minggu, 6 = Sabtu

            if (day === 0 || day === 6) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tanggal tidak valid',
                    text: 'Pilih tanggal antara hari Senin hingga Jumat.',
                    confirmButtonColor: '#3b82f6'
                });
                tanggalInput.value = ''; // kosongkan input
            } else {
                checkAvailability(); // lanjutkan cek ketersediaan
            }
        });

        labSelect.addEventListener('change', checkAvailability);
        tanggalInput.addEventListener('change', checkAvailability);
        waktuSelect.addEventListener('change', checkAvailability);

        checkAvailability();
    </script>
@endsection