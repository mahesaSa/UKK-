@extends('layouts.appsiswa')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<div class="hero-bg py-16 "> {{-- Tambahkan bg-gray-900 sebagai fallback --}}
    <div class="max-w-6xl mx-auto px-5 mb-3">
        <div class="fade-up fade-up-1 bg-blue-300 pl-4 py-5 rounded-xl">
            <p class="text-amber-400 text-sm font-semibold tracking-widest uppercase mb-2">Selamat datang, {{ Auth::user()->username ?? 'Siswa' }} 👋</p>
            <h1 class="font-display text-white text-4xl md:text-5xl font-black leading-tight mb-4">
                Temukan Buku<br><span class="text-blue-400">Favoritmu</span>
            </h1>
            <p class="text-white/60 text-base max-w-lg mb-8">
                Jelajahi koleksi buku perpustakaan sekolah. Baca, pinjam, dan perluas wawasanmu setiap hari.
            </p>
        </div>

        {{-- Search Bar --}}
        <div class="fade-up fade-up-2 max-w-xl mt-3">
            <form action="{{ route('PageSiswa.buku') }}" method="GET"> {{-- Perbaikan Route --}}
                <div class="flex gap-2">
                    <div class="flex-1 flex items-center bg-white/10 backdrop-blur border border-white/20 rounded-xl px-4 gap-2">
                        <svg class="w-4 h-4 text-white/50 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" placeholder="Cari judul buku atau pengarang..."
                               class="bg-transparent text-white placeholder-white/40 text-sm py-3 flex-1 focus:outline-none">
                    </div>
                    <button type="submit"
                            class="bg-blue-400 hover:bg-blue-500 text-white font-semibold text-sm px-5 py-3 rounded-xl transition">
                        Cari
                    </button>   
                </div>
            </form>
        </div>

        {{-- Stats --}}
        <div class="fade-up fade-up-3 flex flex-wrap gap-8 mt-10">
            <div>
                <p class="text-white font-display text-2xl font-bold">{{ $totalBuku }}</p>
                <p class="text-white/60 text-xs mt-0.5">Total Buku</p>
            </div>
            <div class="border-l border-white/20 pl-8">
                <p class="text-white font-display text-2xl font-bold">{{ $bukuTersedia }}</p>
                <p class="text-white/60 text-xs mt-0.5">Tersedia</p>
            </div>
            <div class="border-l border-white/20 pl-8">
                <p class="text-white font-display text-2xl font-bold">{{ $totalPengarang }}</p>
                <p class="text-white/60 text-xs mt-0.5">Pengarang</p>
            </div>
            <div class="border-l border-white/20 pl-8">
                <a href="{{ route('PageSiswa.transaksi') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                    Lihat Transaksi Saya
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">

    {{-- ===== REKOMENDASI ===== --}}
    <div class="fade-up fade-up-1 mb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-display text-2xl font-bold text-gray-800">✨ Rekomendasi Buku</h2>
                <p class="text-sm text-gray-500 mt-1">Buku pilihan dengan stok terbanyak</p>
            </div>
            <a href="{{ route('PageSiswa.buku') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold transition">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5"> 
            @foreach($rekomendasi as $buku)
            <a href="{{ route('PageSiswa.detail', $buku->id_buku) }}" 
               class="card-hover bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm block transition hover:shadow-md">
                {{-- Cover Visual --}}
                <div class="h-40 flex items-center justify-center relative overflow-hidden"
                     style="background: {{ $loop->index % 4 === 0 ? 'linear-gradient(135deg,#667eea,#764ba2)' : ($loop->index % 4 === 1 ? 'linear-gradient(135deg,#f093fb,#f5576c)' : ($loop->index % 4 === 2 ? 'linear-gradient(135deg,#4facfe,#00f2fe)' : 'linear-gradient(135deg,#43e97b,#38f9d7)')) }}">
                    <div class="relative text-center px-4">
                        <svg class="w-10 h-10 text-white/80 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <p class="text-white font-bold text-xs line-clamp-2">{{ $buku->judul_buku }}</p>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/20 backdrop-blur text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                            Stok {{ $buku->stok }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-gray-800 text-sm line-clamp-1 mb-1">{{ $buku->judul_buku }}</h3>
                    <p class="text-[11px] text-gray-500 mb-3">{{ $buku->pengarang }}</p>
                    <div class="flex items-center justify-between border-t pt-3">
                        <span class="text-[10px] text-gray-400 font-medium">{{ $buku->penerbit }}</span>
                        <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">{{ $buku->tahun_terbit }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ===== RIWAYAT TRANSAKSI TERBARU ===== --}}
    <div class="fade-up fade-up-2 mb-12">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="font-display text-2xl font-bold text-gray-800">📝 Aktivitas Terakhir</h2>
                <p class="text-sm text-gray-500">Buku yang sedang kamu pinjam</p>
            </div>
        </div>

        @if($transaksis->isEmpty())
            <div class="py-10 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 text-center text-gray-400">
                <p class="text-sm">Belum ada riwayat peminjaman.</p>
                <a href="{{ route('PageSiswa.buku') }}" class="text-indigo-600 text-xs font-bold mt-2 inline-block">Mulai Cari Buku →</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($transaksis as $item)
                    <div class="flex items-center gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-800 truncate">{{ $item->buku->judul_buku ?? 'Buku dihapus' }}</p>
                            <p class="text-[11px] text-gray-500">Tempo: {{ \Carbon\Carbon::parse($item->tgl_pengembalian)->format('d M Y') }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider
                            {{ $item->status_transaksi === 'Kembali' ? 'bg-green-100 text-green-700' : ($item->status_transaksi === 'Terlambat' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ $item->status_transaksi }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ===== SEMUA BUKU ===== --}}
    <div class="fade-up fade-up-2">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-display text-2xl font-bold text-gray-800">📚 Koleksi Perpustakaan</h2>
                <p class="text-sm text-gray-500 mt-1">Jelajahi semua buku yang tersedia</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($bukus as $buku)
            <a href="{{ route('PageSiswa.detail', $buku->id_buku) }}" {{-- id_buku ke id --}}
               class="card-hover bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex gap-4 items-start transition hover:border-indigo-200">
                
                {{-- Mini Cover --}}
                <div class="w-12 h-16 rounded-lg flex items-center justify-center shrink-0"
                     style="background: {{ $loop->index % 5 === 0 ? 'linear-gradient(135deg,#667eea,#764ba2)' : ($loop->index % 5 === 1 ? 'linear-gradient(135deg,#f093fb,#f5576c)' : ($loop->index % 5 === 2 ? 'linear-gradient(135deg,#4facfe,#00f2fe)' : ($loop->index % 5 === 3 ? 'linear-gradient(135deg,#43e97b,#38f9d7)' : 'linear-gradient(135deg,#fa709a,#fee140)'))) }}">
                    <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 text-sm line-clamp-1 mb-0.5">{{ $buku->judul_buku }}</h3>
                    <p class="text-[11px] text-gray-500 mb-2 truncate">{{ $buku->pengarang }}</p>
                    <div class="flex items-center gap-2">
                        @if($buku->stok > 0)
                            <span class="text-[10px] bg-green-50 text-green-600 font-bold px-2 py-0.5 rounded-full border border-green-100">
                                Tersedia ({{ $buku->stok }})
                            </span>
                        @else
                            <span class="text-[10px] bg-red-50 text-red-600 font-bold px-2 py-0.5 rounded-full border border-red-100">
                                Habis
                            </span>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-16 text-center text-gray-400">
                <p class="text-sm">Belum ada buku tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection