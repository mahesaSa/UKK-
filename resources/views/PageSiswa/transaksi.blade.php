@extends('layouts.appsiswa')

@section('title', 'Riwayat Pinjam')

@section('content')

{{-- Header Section dengan Gradient Soft --}}
<div class="bg-gradient-to-r from-indigo-600 to-blue-500 pt-12 pb-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="font-display text-4xl font-extrabold text-white mb-2">Riwayat Literasi</h1>
        <p class="text-indigo-100 opacity-90 text-base">Pantau aktivitas peminjaman dan kembangkan wawasanmu</p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 mt-4 rounded-xl">
    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 ">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-gray-800">{{ $aktif }}</p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Aktif</p>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 flex items-center gap-4">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-red-600">{{ $terlambat }}</p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Terlambat</p>
            </div>
        </div>
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-green-600">{{ $dikembalikan }}</p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Selesai</p>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="mb-8 animate-bounce bg-green-500 text-white px-6 py-4 rounded-2xl shadow-lg flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Grid Kartu Riwayat --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-20">
        @forelse($transaksis as $item)
        @php
            $status = strtolower($item->status_transaksi);
            $sisaHari = now()->diffInDays($item->tgl_pengembalian, false);
            
            $statusConfig = match($status) {
                'dipinjam'  => ['color' => 'blue', 'label' => 'Masa Pinjam'],
                'terlambat' => ['color' => 'red', 'label' => 'Overdue'],
                'kembali'   => ['color' => 'green', 'label' => 'Sudah Kembali'],
                default     => ['color' => 'gray', 'label' => $status],
            };
        @endphp

        <div class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            {{-- Bagian Atas: Visual Status --}}
            <div class="h-3 bg-{{ $statusConfig['color'] }}-500"></div>
            
            <div class="p-6 flex-1">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-3 py-1 bg-{{ $statusConfig['color'] }}-50 text-{{ $statusConfig['color'] }}-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ $statusConfig['label'] }}
                    </span>
                    <span class="text-gray-300 group-hover:text-indigo-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                </div>

                <h3 class="font-black text-gray-800 text-lg leading-tight mb-1 line-clamp-2">
                    {{ $item->buku->judul_buku ?? 'Judul Tidak Tersedia' }}
                </h3>
                <p class="text-xs text-gray-400 mb-6 italic">{{ $item->buku->pengarang ?? 'Tanpa Pengarang' }}</p>

                <div class="space-y-3 border-t border-gray-50 pt-4">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Tanggal Pinjam</span>
                        <span class="font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Jatuh Tempo</span>
                        <span class="font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_pengembalian)->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                {{-- Status Khusus --}}
                <div class="mt-5">
                    @if($status === 'dipinjam')
                        <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full" style="width: {{ max(10, 100 - ($sisaHari * 10)) }}%"></div>
                        </div>
                        <p class="text-[10px] text-{{ $sisaHari < 2 ? 'red' : 'blue' }}-500 mt-2 font-bold uppercase">
                            ⌛ Sisa {{ $sisaHari }} Hari Lagi
                        </p>
                    @elseif($status === 'terlambat')
                        <div class="bg-red-50 p-3 rounded-xl border border-red-100">
                            <p class="text-[10px] text-red-600 font-bold leading-tight uppercase">
                                🚨 Terlambat {{ abs($sisaHari) }} Hari! <br> Harap segera ke perpustakaan.
                            </p>
                        </div>
                    @else
                        <div class="flex items-center gap-2 text-green-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-[10px] font-black uppercase">Selesai</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Action Button --}}
            @if($status !== 'kembali')
            <div class="p-6 pt-0">
                <form action="{{ route('PageSiswa.kembalikan', $item->id_transaksi) }}" method="POST"
                      onsubmit="return confirm('Apakah kamu yakin ingin mengembalikan buku ini?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full bg-gray-900 hover:bg-indigo-600 text-white text-xs font-bold py-3 rounded-xl transition-all duration-300 shadow-lg hover:shadow-indigo-200">
                        KEMBALIKAN SEKARANG
                    </button>
                </form>
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Riwayat masih kosong</h2>
            <p class="text-gray-400 text-sm mt-1 mb-6">Kamu belum meminjam buku apapun sejauh ini.</p>
            <a href="{{ route('PageSiswa.buku') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-indigo-700 transition">
                Cari Buku Pertama
            </a>
        </div>
        @endforelse
    </div>

    {{-- Link Pagination (Jika ada) --}}
    <div class="mt-10">
        {{ $transaksis->links() }}
    </div>
</div>

@endsection