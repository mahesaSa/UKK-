@extends('layouts.appsiswa')

@section('title', 'Koleksi Perpustakaan')

@section('content')

{{-- Header Section --}}
<div class="bg-gray-50 border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-indigo-500 mb-3">
                    <span class="px-2 py-1 bg-indigo-50 rounded">Digital Library</span>
                    <span class="text-gray-300">/</span>
                    <span class="text-gray-400">Katalog Buku</span>
                </nav>
                <h1 class="font-display text-4xl font-black text-gray-900 tracking-tight">Koleksi Buku</h1>
                <p class="text-gray-500 text-sm mt-2 max-w-md">Jelajahi ribuan ilmu pengetahuan yang siap kamu pinjam dan pelajari hari ini.</p>
            </div>

            <form method="GET" action="{{ route('PageSiswa.buku') }}" class="w-full md:w-96">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Judul, penulis, atau penerbit..."
                           class="w-full bg-white border border-gray-200 rounded-2xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 transition-all shadow-sm">
                    
                    @if(request('search'))
                        <a href="{{ route('PageSiswa.buku') }}" class="absolute inset-y-0 right-12 flex items-center text-gray-400 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if(request('search'))
            <div class="mt-6 flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest">
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                Ditemukan {{ $bukus->count() }} hasil untuk "{{ request('search') }}"
            </div>
        @endif
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-10">
    
    {{-- Flash Message --}}
    @if(session('success') || session('error'))
    <div class="mb-8">
        @if(session('success'))
            <div class="bg-green-500 text-white text-xs font-bold px-6 py-4 rounded-2xl shadow-lg shadow-green-500/20 flex items-center gap-3 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white text-xs font-bold px-6 py-4 rounded-2xl shadow-lg shadow-red-500/20 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif
    </div>
    @endif

    {{-- Grid Buku --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($bukus as $buku)
        <div class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col overflow-hidden">
            
            {{-- Visual Top Section --}}
            <div class="relative aspect-[4/3] overflow-hidden bg-gray-900">
                {{-- Gradient Overlay sesuai index --}}
                <div class="absolute inset-0 opacity-80 group-hover:opacity-100 transition-opacity duration-500"
                     style="background: {{ $loop->index % 4 === 0 ? 'linear-gradient(135deg,#6366f1,#a855f7)' : ($loop->index % 4 === 1 ? 'linear-gradient(135deg,#3b82f6,#2dd4bf)' : ($loop->index % 4 === 2 ? 'linear-gradient(135deg,#f43f5e,#fb923c)' : 'linear-gradient(135deg,#06b6d4,#3b82f6)')) }}">
                </div>
                
                {{-- Badge Stok --}}
                <div class="absolute top-4 right-4 z-10">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter shadow-sm {{ $buku->stok > 0 ? 'bg-white text-indigo-600' : 'bg-red-500 text-white' }}">
                        {{ $buku->stok > 0 ? $buku->stok . ' Tersedia' : 'Habis' }}
                    </span>
                </div>

                {{-- Center Icon --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/20 group-hover:scale-125 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>

                {{-- Hover Link Overlay --}}
                <a href="{{ route('PageSiswa.detail', $buku->id_buku) }}" class="absolute inset-0 z-20"></a>
            </div>

            {{-- Content Section --}}
            <div class="p-6 flex flex-col flex-1">
                <p class="text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-2">{{ $buku->penerbit }}</p>
                <a href="{{ route('PageSiswa.detail', $buku->id_buku) }}" class="block">
                    <h3 class="font-bold text-gray-900 text-base leading-snug group-hover:text-indigo-600 transition-colors line-clamp-2 mb-2">
                        {{ $buku->judul_buku }}
                    </h3>
                </a>
                <p class="text-xs text-gray-400 font-medium mb-6 italic">{{ $buku->pengarang }}</p>

                <div class="mt-auto pt-5 border-t border-gray-50 flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-300 font-bold uppercase tracking-tighter">Tahun</span>
                        <span class="text-xs font-black text-gray-700">{{ $buku->tahun_terbit }}</span>
                    </div>

                    @if($buku->stok > 0)
                        <form action="{{ route('PageSiswa.pinjam', $buku->id_buku) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-900 hover:bg-indigo-600 text-white p-2.5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-indigo-200 group/btn">
                                <svg class="w-5 h-5 group-hover/btn:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </form>
                    @else
                        <div class="bg-gray-50 p-2.5 rounded-xl text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-800 tracking-tight">Pencarian Nihil</h3>
            <p class="text-gray-400 text-sm mt-2 mb-8">Tidak ada buku yang cocok dengan kata kunci "{{ request('search') }}"</p>
            <a href="{{ route('PageSiswa.buku') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-indigo-700 transition shadow-xl shadow-indigo-100">Reset Pencarian</a>
        </div>
        @endforelse
    </div>

    {{-- Pagination Area --}}
    <div class="mt-16">
        {{ $bukus->appends(['search' => request('search')])->links() }}
    </div>
</div>

@endsection