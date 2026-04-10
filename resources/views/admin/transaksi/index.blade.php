@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Transaksi Buku</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola peminjaman dan pengembalian buku</p>
        </div>
        <a href="{{ route('transaksi.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Transaksi
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <p class="text-xs text-gray-500 font-bold uppercase">Total</p>
            <p class="text-2xl font-black text-gray-800 mt-1">{{ $total }}</p>
        </div>

        <div class="bg-white rounded-xl border border-blue-100 p-4 shadow-sm">
            <p class="text-xs text-blue-500 font-bold uppercase">Dipinjam</p>
            <p class="text-2xl font-black text-blue-600 mt-1">{{ $dipinjam }}</p>
        </div>

        <div class="bg-white rounded-xl border border-red-100 p-4 shadow-sm">
            <p class="text-xs text-red-500 font-bold uppercase">Terlambat</p>
            <p class="text-2xl font-black text-red-600 mt-1">{{ $terlambat }}</p>
        </div>

        <div class="bg-white rounded-xl border border-green-100 p-4 shadow-sm">
            <p class="text-xs text-green-500 font-bold uppercase">Kembali</p>
            <p class="text-2xl font-black text-green-600 mt-1">{{ $dikembalikan }}</p>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('transaksi.index') }}" class="flex flex-wrap gap-3">
            <div class="flex-1 min-w-[250px] relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari Username, NISN, atau Judul Buku..."
                       class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>

            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
                <option value="semua">Semua Status</option>
                <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="Kembali" {{ request('status') == 'Kembali' ? 'selected' : '' }}>Kembali</option>
            </select>

            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg text-sm font-semibold transition">
                Filter
            </button>
            <a href="{{ route('transaksi.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-5 py-2 rounded-lg text-sm font-semibold transition">
                Reset
            </a>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Buku</th>
                        <th class="px-6 py-4">Waktu Pinjam</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($transaksi as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">{{ $item->user->username }}</span>
                                <span class="text-xs text-gray-500">NISN: {{ $item->user->nisn ?? '-' }}</span>
                                <span class="text-[10px] uppercase font-medium text-indigo-500">{{ $item->user->kelas ?? 'Umum' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="max-w-[200px] truncate font-medium text-gray-700" title="{{ $item->buku->judul_buku }}">
                                {{ $item->buku->judul_buku }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs space-y-1">
                                <div class="flex items-center gap-1 text-gray-600">
                                    <span class="w-16 font-semibold">Pinjam:</span>
                                    {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}
                                </div>
                                <div class="flex items-center gap-1 text-gray-500 italic">
                                    <span class="w-16 font-semibold">Tempo:</span>
                                    {{ \Carbon\Carbon::parse($item->tgl_pengembalian)->format('d/m/Y') }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $isTerlambat = strtolower($item->status_transaksi) === 'dipinjam' && now()->gt($item->tgl_pengembalian);
                            @endphp

                            @if($isTerlambat)
                                <span class="px-2.5 py-1 bg-red-100 text-red-700 text-[10px] font-bold rounded-full uppercase tracking-wider border border-red-200">Terlambat</span>
                            @elseif(strtolower($item->status_transaksi) === 'dipinjam')
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full uppercase tracking-wider border border-blue-200">Dipinjam</span>
                            @else
                                <span class="px-2.5 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full uppercase tracking-wider border border-green-200">Kembali</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Tombol Kembalikan (Cepat) --}}
                                @if(strtolower($item->status_transaksi) === 'dipinjam')
                                <form action="{{ route('transaksi.kembalikan', $item->id_buku) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition" title="Tandai Kembali">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('transaksi.show', $item->id_buku) }}" class="p-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-200 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>

                                <form action="{{ route('transaksi.destroy', $item->id_buku) }}" method="POST" onsubmit="return confirm('Hapus riwayat transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Belum ada data transaksi peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transaksi->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $transaksi->links() }}
        </div>
        @endif
    </div>
</div>
@endsection