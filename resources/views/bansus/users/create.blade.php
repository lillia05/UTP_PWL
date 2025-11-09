
{{-- resources/views/bansus/users/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="mb-6">
        <a href="{{ route('bansus.users.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
            ← Kembali ke Daftar User
        </a>
    </div>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Tambah User Baru</h3>
        </div>

        <form method="POST" action="{{ route('bansus.users.store') }}" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    required 
                    autofocus
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                <select 
                    name="role" 
                    id="role" 
                    required
                    onchange="toggleMahasiswaFields()"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-500 @enderror"
                >
                    <option value="">-- Pilih Role --</option>
                    <option value="mahasiswa" {{ old('role') === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="bansus" {{ old('role') === 'bansus' ? 'selected' : '' }}>Bansus</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="mahasiswa-fields" style="display: none;">
                <div class="space-y-6 p-4 bg-blue-50 rounded-md">
                    <p class="text-sm text-blue-800 font-medium">Field khusus untuk Mahasiswa:</p>
                    
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                        <input 
                            type="text" 
                            name="nim" 
                            id="nim" 
                            value="{{ old('nim') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nim') border-red-500 @enderror"
                        >
                        @error('nim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                        <div class="mb-4">
                            <label for="jurusan" class="block text-sm font-medium text-gray-700">
                             Jurusan <span class="text-red-500">*</span>
                             </label>

                            <input 
                                type="text" 
                                name="jurusan" 
                                id="jurusan" 
                                value="{{ old('jurusan', 'Ilmu Komputer') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('jurusan') border-red-500 @enderror"
                            >

                            @error('jurusan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                >
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('bansus.users.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleMahasiswaFields() {
        const role = document.getElementById('role').value;
        const mahasiswaFields = document.getElementById('mahasiswa-fields');
        const nimInput = document.getElementById('nim');
        const jurusanInput = document.getElementById('jurusan');
        
        if (role === 'mahasiswa') {
            mahasiswaFields.style.display = 'block';
            nimInput.required = true;
            jurusanInput.required = true;
        } else {
            mahasiswaFields.style.display = 'none';
            nimInput.required = false;
            jurusanInput.required = false;
        }
    }

    // Check on page load (for old values)
    document.addEventListener('DOMContentLoaded', function() {
        toggleMahasiswaFields();
    });
</script>
@endsection