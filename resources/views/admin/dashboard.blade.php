@extends('layouts.app')

@section('content')
<div class="space-y-6 w-full p-6">

    {{-- Header --}}
    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali!</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl border border-indigo-200 p-5 shadow-sm">
            <p class="text-xs text-indigo-500 font-medium uppercase tracking-wide">Total Siswa</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $stats['total_siswa'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Siswa terdaftar</p>
        </div>

        <div class="bg-white rounded-xl border border-amber-200 p-5 shadow-sm">
            <p class="text-xs text-amber-500 font-medium uppercase tracking-wide">Stok Buku</p>
            <p class="text-3xl font-bold text-amber-500 mt-1">{{ $stats['total_buku'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Total stok tersedia</p>
        </div>

        <div class="bg-white rounded-xl border border-green-200 p-5 shadow-sm">
            <p class="text-xs text-green-600 font-medium uppercase tracking-wide">Total Peminjam</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['total_pinjam'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Sedang dipinjam</p>
        </div>

    </div>

    {{-- Tabel Transaksi Terbaru --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-700">Transaksi Terbaru</h3>
            <a href="{{ route('transaksi.index') }}"
               class="text-xs text-indigo-600 hover:underline font-medium">Lihat Semua →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-5 py-3 text-center w-10">No</th>
                        <th class="px-5 py-3">Siswa</th>
                        <th class="px-5 py-3">Judul Buku</th>
                        <th class="px-5 py-3">Tgl Pinjam</th>
                        <th class="px-5 py-3">Tgl Kembali</th>
                        <th class="px-5 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($transaksi as $i => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3 text-center text-gray-500">{{ $i + 1 }}</td>
                        <td class="px-5 py-3 font-semibold text-gray-800">
                            {{ $item->user->username ?? '-' }}
                        </td>
                        <td class="px-5 py-3 text-gray-700">
                            {{ $item->buku->judul_buku ?? '-' }}
                        </td>
                        <td class="px-5 py-3 text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-5 py-3 text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tgl_pengembalian)->format('d M Y') }}
                        </td>
                        <td class="px-5 py-3">
                            @if($item->status_transaksi === 'Dipinjam')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Dipinjam</span>
                            @elseif($item->status_transaksi === 'Kembali')
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Dikembalikan</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-full">Terlambat</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-gray-400 text-sm">
                            Belum ada transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50">
            <p class="text-xs text-gray-400 italic">* Menampilkan 5 transaksi terbaru</p>
        </div>

    </div>

</div>
@endsection