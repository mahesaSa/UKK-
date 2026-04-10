@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar User</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola akun Admin dan Siswa dalam satu sistem</p>
        </div>
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah User
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div id="alert-success" class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm flex items-center justify-between animate-fade-in">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-3 text-center w-12">No</th>
                        <th class="px-4 py-3">Identitas / Username</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3 text-center">NISN / Kelas</th> {{-- Kolom Baru --}}
                        <th class="px-4 py-3 text-center">Role</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                   @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-4 py-3 text-center text-gray-400 font-mono text-xs">{{ $loop->iteration }}</td>

                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }} flex items-center justify-center font-bold text-sm uppercase border border-white shadow-sm">
                                    {{ substr($user->username, 0, 1) }}
                                </div>
                                <div>
                                    <span class="block font-semibold text-gray-800">{{ $user->username }}</span>
                                    <span class="text-[10px] text-gray-400 uppercase tracking-tighter italic">ID: #{{ $user->id }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>

                        {{-- Menampilkan NISN dan Kelas jika Siswa --}}
                        <td class="px-4 py-3 text-center">
                            @if($user->role === 'siswa')
                                <div class="text-xs">
                                    <span class="font-medium text-gray-700 block">{{ $user->nisn }}</span>
                                    <span class="text-gray-400">{{ $user->kelas }}</span>
                                </div>
                            @else
                                <span class="text-gray-300 italic text-xs">- Internal Admin -</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($user->role === 'admin')
                                <span class="inline-flex items-center px-2.5 py-0.5 bg-purple-50 text-purple-700 text-[10px] font-bold rounded-full border border-purple-100">
                                    ADMIN
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-full border border-blue-100">
                                    SISWA
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1">
                                {{-- Edit --}}
                                <a href="{{ route('users.edit', $user->id) }}" 
                                   class="p-2 rounded-lg text-amber-500 hover:bg-amber-50 hover:text-amber-600 transition" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->username }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition" title="Hapus User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="text-sm">Tidak ada data pengguna ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
            <p class="text-[10px] text-gray-400 uppercase font-semibold tracking-widest">Total: {{ $users->count() }} Pengguna Terdaftar</p>
        </div>
    </div>

</div>

{{-- Script untuk menghilangkan alert otomatis (opsional) --}}
<script>
    setTimeout(() => {
        const alert = document.getElementById('alert-success');
        if(alert) alert.style.display = 'none';
    }, 3000);
</script>

@endsection