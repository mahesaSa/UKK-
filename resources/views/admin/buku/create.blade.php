@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Buku</h1>
            <p class="text-sm text-gray-500 mt-1">Isi data buku baru di bawah ini</p>
        </div>
        <a href="{{ route('bukus.index') }}"
           class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-100 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="max-w-xl bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-700">Data Buku</h2>
        </div>

        <div class="p-6">

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bukus.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Judul Buku --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Buku</label>
                    <input type="text" name="judul_buku" value="{{ old('judul_buku') }}"
                           placeholder="Masukkan judul buku"
                           class="w-full border @error('judul_buku') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @error('judul_buku')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pengarang --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Pengarang</label>
                    <input type="text" name="pengarang" value="{{ old('pengarang') }}"
                           placeholder="Nama pengarang"
                           class="w-full border @error('pengarang') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @error('pengarang')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit') }}"
                           placeholder="Nama penerbit"
                           class="w-full border @error('penerbit') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @error('penerbit')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun Terbit & Stok (2 kolom) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                               placeholder="Contoh: 2023"
                               class="w-full border @error('tahun_terbit') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        @error('tahun_terbit')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stok" value="{{ old('stok') }}"
                               placeholder="Jumlah stok" min="0"
                               class="w-full border @error('stok') border-red-400 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        @error('stok')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                        Simpan Buku
                    </button>
                    <a href="{{ route('bukus.index') }}"
                       class="flex-1 text-center border border-gray-300 hover:bg-gray-100 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection