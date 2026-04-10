@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Buku</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola katalog buku perpustakaan</p>
        </div>
        <a href="{{ route('bukus.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Buku
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div id="alert-success" class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="alert-error" class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-3 text-center w-12">No</th>
                        <th class="px-4 py-3">Judul Buku</th>
                        <th class="px-4 py-3">Pengarang</th>
                        <th class="px-4 py-3">Penerbit</th>
                        <th class="px-4 py-3 text-center">Tahun Terbit</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($bukus as $buku)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-500">{{ $loop->iteration }}</td>

                        <td class="px-4 py-3 font-semibold text-gray-800">{{ $buku->judul_buku }}</td>

                        <td class="px-4 py-3 text-gray-600">{{ $buku->pengarang }}</td>

                        <td class="px-4 py-3 text-gray-600">{{ $buku->penerbit }}</td>

                        <td class="px-4 py-3 text-center text-gray-600">{{ $buku->tahun_terbit }}</td>

                        <td class="px-4 py-3 text-center">
                            @if($buku->stok > 0)
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                    {{ $buku->stok }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-full">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1">
                                {{-- Edit --}}
                                <a href="{{ route('bukus.edit', $buku->id_buku) }}"
                                   title="Edit"
                                   class="p-1.5 rounded-lg text-amber-500 hover:bg-amber-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                <a href="{{ route('bukus.show', $buku->id_buku) }}" class="text-blue-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('bukus.destroy', $buku->id_buku) }}" method="POST"
                                      onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus"
                                            class="p-1.5 rounded-lg text-red-500 hover:bg-red-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-gray-400 text-sm">
                            Belum ada data buku.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
            <p class="text-xs text-gray-400">Menampilkan {{ $bukus->count() }} buku</p>
        </div>
    </div>

</div>
@endsection