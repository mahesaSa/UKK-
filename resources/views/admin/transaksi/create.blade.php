@extends('layouts.app')

@section('content')
<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Transaksi</h1>
            <p class="text-sm text-gray-500 mt-1">Isi data peminjaman buku</p>
        </div>
        <a href="{{ route('transaksi.index') }}"
           class="border border-gray-300 hover:bg-gray-100 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">
            ← Kembali
        </a>
    </div>

    <div class="max-w-xl bg-white rounded-xl border border-gray-200 shadow-sm p-6">

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                @foreach($errors->all() as $e)
                    <p>• {{ $e }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Siswa</label>
                <select name="id_siswa" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}" {{ old('id_siswa') == $s->id ? 'selected' : '' }}>
                            {{ $s->username }}
                        </option>
                    @endforeach
                </select>
                @error('id_siswa') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Buku</label>
                <select name="id_buku" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="">-- Pilih Buku --</option>
                    @foreach($buku as $b)
                        <option value="{{ $b->id_buku }}" {{ old('id_buku') == $b->id_buku ? 'selected' : '' }}>
                            {{ $b->judul_buku }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
                @error('id_buku') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                @error('tgl_pinjam') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Kembali</label>
                <input type="date" name="tgl_pengembalian" value="{{ old('tgl_pengembalian') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                @error('tgl_pengembalian') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                    Simpan
                </button>
                <a href="{{ route('transaksi.index') }}"
                   class="flex-1 text-center border border-gray-300 hover:bg-gray-100 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>
@endsection 