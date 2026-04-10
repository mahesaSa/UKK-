@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
            <p class="text-sm text-gray-500 mt-1">Ubah data akun pengguna</p>
        </div>
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden w-full">
        <div class="px-6 py-4 bg-amber-50 border-b border-amber-100">
            <h2 class="text-sm font-bold text-amber-700">Edit Data User — {{ $user->username }}</h2>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                       class="w-full px-3 py-2 border @error('username') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                @error('username')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-3 py-2 border @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="role" id="roleSelect"
                        class="w-full px-3 py-2 border @error('role') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
                @error('role')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div id="siswaFields" class="{{ old('role', $user->role) == 'siswa' ? '' : 'hidden' }} space-y-5 p-4 bg-blue-50 rounded-lg border border-blue-100">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 text-blue-800">NISN (Khusus Siswa)</label>
                    <input type="text" name="nisn" value="{{ old('nisn', $user->nisn) }}"
                           class="w-full px-3 py-2 border @error('nisn') border-red-400 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('nisn') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 text-blue-800">Kelas (Khusus Siswa)</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $user->kelas) }}"
                           class="w-full px-3 py-2 border @error('kelas') border-red-400 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('kelas') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Password  --}}
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 mb-3 font-medium italic">🔒 Kosongkan jika tidak ingin mengganti password</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password"
                               class="w-full px-3 py-2 border @error('password') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                               placeholder="Minimal 6 karakter">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                               placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-2 flex gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-6 py-2 rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Data
                </button>
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-6 py-2 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT DYNAMIC ROLE --}}
<script>
    const roleSelect = document.getElementById('roleSelect');
    const siswaFields = document.getElementById('siswaFields');

    roleSelect.addEventListener('change', function() {
        if (this.value === 'siswa') {
            siswaFields.classList.remove('hidden');
        } else {
            siswaFields.classList.add('hidden');
        }
    });
</script>
@endsection