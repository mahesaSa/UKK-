@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail User</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap akun pengguna</p>
        </div>
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden w-full">

        {{-- Card Header --}}
        <div class="px-6 py-4 bg-indigo-50 border-b border-indigo-100 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-lg uppercase">
                {{ substr($user->username, 0, 1) }}
            </div>
            <div>
                <h2 class="text-base font-bold text-indigo-800">{{ $user->username }}</h2>
                <p class="text-xs text-indigo-500">ID: #{{ $user->id }}</p>
            </div>
        </div>

        {{-- Detail Fields --}}
        <div class="divide-y divide-gray-100">

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Username</span>
                <span class="text-sm text-gray-800 font-semibold">{{ $user->username }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Email</span>
                <span class="text-sm text-gray-800">{{ $user->email }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Role</span>
                @if($user->role === 'admin')
                    <span class="inline-flex items-center px-2.5 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                        Admin
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-600 text-xs font-semibold rounded-full">
                        Siswa
                    </span>
                @endif
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Dibuat</span>
                <span class="text-sm text-gray-800">{{ $user->created_at->format('d M Y, H:i') }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Diupdate</span>
                <span class="text-sm text-gray-800">{{ $user->updated_at->format('d M Y, H:i') }}</span>
            </div>

        </div>

        {{-- Action Buttons --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-2">
            <a href="{{ route('users.edit', $user->id) }}"
               class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit User
            </a>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                  onsubmit="return confirm('Hapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus User
                </button>
            </form>
        </div>

    </div>

</div>
@endsection