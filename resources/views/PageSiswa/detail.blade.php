@extends('layouts.appsiswa')

@section('title', $buku->judul_buku)

@section('content')

<div class="max-w-5xl mx-auto px-6 py-12">

    {{-- Breadcrumb Modern --}}
    <nav class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-gray-400 mb-10">
        <a href="{{ route('PageSiswa.home') }}" class="hover:text-indigo-600 transition">Beranda</a>
        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
        <a href="{{ route('PageSiswa.buku') }}" class="hover:text-indigo-600 transition">Koleksi</a>
        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
        <span class="text-indigo-600 truncate max-w-[200px]">{{ $buku->judul_buku }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12 items-start">  

        <div class="w-full lg:w-72 shrink-0">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                
                <div class="relative w-full aspect-[3/4] rounded-2xl shadow-2xl flex flex-col items-center justify-center overflow-hidden"
                     style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%)">
                    
                    <div class="absolute top-0 right-0 p-4 opacity-20">
                        <svg class="w-20 h-20 text-black" fill="currentColor" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="2" fill="none" />
                        </svg>
                    </div>

                    <svg class="w-20 h-20 text-indigo-300/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-white     font-display font-black text-lg text-center px-6 leading-tight uppercase tracking-tighter italic">
                        {{ $buku->judul_buku }}
                    </p>
                </div>
            </div>

            <div class="mt-6 p-4 rounded-xl border {{ $buku->stok > 0 ? 'bg-green-50 border-green-100' : 'bg-red-50 border-red-100' }} text-center">
                <p class="text-[10px] font-black uppercase tracking-widest {{ $buku->stok > 0 ? 'text-green-600' : 'text-red-600' }} mb-1">
                    Status Ketersediaan
                </p>
                <p class="text-sm font-bold text-gray-800">
                    {{ $buku->stok > 0 ? $buku->stok . ' Eksemplar Tersedia' : 'Sedang Kosong' }}
                </p>
            </div>
        </div>
    </div>

    <div class="flex-1 mt-3">  
            <h1 class="text-4xl lg:text-5xl font-black text-gray-900 leading-[1.1] mb-4 tracking-tight">
                {{ $buku->judul_buku }}
            </h1>
            
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center font-bold text-gray-500 uppercase text-xs">
                    {{ substr($buku->pengarang, 0, 2) }}
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Penulis Utama</p>
                    <p class="text-gray-800 font-bold">{{ $buku->pengarang }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 mb-10">
                <div class="border-l-4 border-indigo-500 pl-4 py-1">
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">Penerbit</p>
                    <p class="font-bold text-gray-800">{{ $buku->penerbit }}</p>
                </div>
                <div class="border-l-4 border-purple-500 pl-4 py-1">
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">Tahun</p>
                    <p class="font-bold text-gray-800">{{ $buku->tahun_terbit }}</p>
                </div>
                <div class="border-l-4 border-amber-500 pl-4 py-1">
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">ID Buku</p>
                    <p class="font-bold text-gray-800">#{{ $buku->id_buku }}</p>
                </div>
            </div>

            <div class="bg-gray-700 rounded-xl p-8 shadow-2xl relative overflow-hidden ">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg- rounded-full blur-2xl"></div>
                
                <div class="relative z-10">
                    <h3 class="text-black font-bold mb-2">Konfirmasi Peminjaman</h3>
                    <p class="text-gray-400 text-xs mb-6 italic">Siswa berhak meminjam selama 7 hari kalender. Harap jaga kondisi buku tetap baik.</p>
                    
                    @if($buku->stok > 0)
                        <form action="{{ route('PageSiswa.pinjam', $buku->id_buku) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="group w-full bg-blue-500 hover:bg-blue-400 text-white hover:text-white font-black text-sm py-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                PINJAM SEKARANG
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-800 text-gray-500 font-black text-sm py-4 rounded-2xl cursor-not-allowed border border-gray-700">
                            STOK TIDAK TERSEDIA
                        </button>
                    @endif
                </div>
            </div>

            {{-- Flash Messages --}}
            <div class="mt-4">
                @if(session('success'))
                    <div class="bg-green-500 text-white font-bold text-xs p-4 rounded-xl shadow-lg animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-500 text-white font-bold text-xs p-4 rounded-xl shadow-lg">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

    {{-- Rekomendasi Section --}}
    @if($bukuLain->count() > 0)
    <div class="mt-24">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Mungkin Kamu Suka</h2>
            <a href="{{ route('PageSiswa.buku') }}" class="text-xs font-bold text-indigo-600 hover:underline tracking-widest uppercase">Lihat Semua →</a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($bukuLain as $lain)
            <a href="{{ route('PageSiswa.detail', $lain->id_buku) }}" class="group">
                <div class="aspect-[3/4] rounded-2xl mb-4 overflow-hidden relative shadow-md transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-xl"
                     style="background: {{ $loop->index % 2 === 0 ? 'linear-gradient(45deg,#4338ca,#6366f1)' : 'linear-gradient(45deg,#1e1b4b,#4338ca)' }}">
                    <div class="absolute inset-0 flex items-center justify-center p-4 text-center">
                        <p class="text-white font-black text-[10px] uppercase tracking-tighter opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Lihat Detail
                        </p>
                    </div>
                </div>
                <h4 class="font-bold text-gray-800 text-xs line-clamp-1 uppercase">{{ $lain->judul_buku }}</h4>
                <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $lain->pengarang }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
    body { font-family: 'Inter', sans-serif; }
</style>

@endsection