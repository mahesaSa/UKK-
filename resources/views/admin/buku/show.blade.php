@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Buku</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap buku perpustakaan</p>
        </div>
        <a href="{{ route('bukus.index') }}"
           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Card Detail --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden max-w-2xl">

        {{-- Card Header --}}
        <div class="px-6 py-4 bg-indigo-50 border-b border-indigo-100 flex items-center gap-3">
            <div class="p-2 bg-indigo-100 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-indigo-800">{{ $buku->judul_buku }}</h2>
                <p class="text-xs text-indigo-500">ID Buku: #{{ $buku->id_buku }}</p>
            </div>
        </div>

        {{-- Detail Fields --}}
        <div class="divide-y divide-gray-100">

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Judul Buku</span>
                <span class="text-sm text-gray-800 font-semibold text-right">{{ $buku->judul_buku }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Pengarang</span>
                <span class="text-sm text-gray-800 text-right">{{ $buku->pengarang }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Penerbit</span>
                <span class="text-sm text-gray-800 text-right">{{ $buku->penerbit }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Tahun Terbit</span>
                <span class="text-sm text-gray-800 text-right">{{ $buku->tahun_terbit }}</span>
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-500 font-medium w-40">Stok</span>
                <div>
                    @if($buku->stok > 0)
                        <span class="inline-flex items-center px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                            {{ $buku->stok }} Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-full">
                            Habis
                        </span>
                    @endif
                </div>
            </div>

        </div>

        {{-- Action Buttons --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-2">
            <a href="{{ route('bukus.edit', $buku->id_buku) }}"
               class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Buku
            </a>

            <form action="{{ route('bukus.destroy', $buku->id_buku) }}" method="POST"
                  onsubmit="return confirm('Hapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Buku
                </button>
            </form>
        </div>

    </div>

</div>
@endsection