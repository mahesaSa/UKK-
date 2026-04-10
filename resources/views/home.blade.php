<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body>
    <div class="bg-white min-h-screen">
        {{-- ================= NAVBAR ================= --}}
        <nav class="flex items-center justify-between px-8 py-6 bg-white border-b border-slate-100">
            
            {{-- Logo --}}
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 p-1.5 rounded">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
                            S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18
                            s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5
                            16.5 5c1.747 0 3.332.477 4.5 1.253v13
                            C19.832 18.477 18.247 18 16.5 18
                            c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tighter text-slate-800 uppercase">
                    Pustaka
                </span>
            </div>

            {{-- Menu --}}
            <div class="flex items-center gap-6">
                <a href="#" class="text-sm font-medium text-slate-500 hover:text-blue-600">
                    Bantuan
                </a>
                <a href="{{ route('login.siswa') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    Masuk
                </a>
            </div>
        </nav>


        {{-- ================= HERO SECTION ================= --}}
        <section class="relative px-8 py-16 flex flex-col lg:flex-row items-center overflow-hidden">

            {{-- Text Area --}}
            <div class="w-full lg:w-1/2 z-10">
                <span class="inline-block text-blue-600 text-[11px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6">
                    Perpustakaan Digital Sekolah
                </span>

                <h1 class="text-5xl lg:text-6xl font-extrabold leading-[1.1] mb-6 text-slate-900">
                    Temukan <br>
                    Jendela Dunia di <br>
                    <span class="text-blue-600 italic">
                        Perpustakaan Kami
                    </span>
                </h1>

                <p class="text-slate-500 mb-10 max-w-md text-lg leading-relaxed">
                    Akses ribuan koleksi buku digital dan fisik dengan mudah.
                    Mulai petualangan membaca Anda hari ini.
                </p>

                {{-- Search --}}
                <div class="flex bg-white rounded-2xl shadow-xl p-2 max-w-xl ">
                    <input 
                        type="text"
                        placeholder="Cari judul buku, penulis, atau ISBN..."
                        class="flex-1 rounded-xl px-4 py-3 outline-none text-sm text-slate-600"
                    >
                    <button class="bg-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition">
                        Cari Koleksi
                    </button>
                </div>
            </div>

            {{-- Image Area --}}
            <div class="w-full lg:w-1/2 mt-12 lg:mt-0 relative">
                <div class="bg-slate-200 rounded-[2.5rem] w-full h-[480px] overflow-hidden rotate-2 shadow-2xl border-[10px] border-white">
                    <img 
                        src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=1000"
                        alt="Bookshelf"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>

        </section>


        
       {{-- ================= REKOMENDASI ================= --}}
        <section class="px-8 py-20 bg-slate-50/50 mb-7">

            {{-- Heading --}}
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">
                        Rekomendasi Minggu Ini
                    </h2>
                    <p class="text-slate-400 text-sm">
                        Pilihan editor terbaik untuk menemani waktu luang Anda.
                    </p>
                </div>

                <a href="#" class="text-blue-600 font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">
                    Lihat Semua Katalog →
                </a>
            </div>

            {{-- Data Buku dengan Image URL --}}
            @php
                $books = [
                    [
                        'title' => 'The Great Gatsby', 
                        'author' => 'F. Scott Fitzgerald', 
                        'image' => 'https://images.isbndb.com/covers/25/35/9780743273565.jpg'
                    ],
                    [
                        'title' => 'Bumi Manusia', 
                        'author' => 'Pramoedya Ananta Toer', 
                        'image' => 'https://www.gramedia.com/blog/content/images/2020/05/bumi-manusia.jpg'
                    ],
                    [
                        'title' => 'Laskar Pelangi', 
                        'author' => 'Andrea Hirata', 
                        'image' => 'https://upload.wikimedia.org/wikipedia/id/8/8e/Laskar_pelangi_sampul.jpg'
                    ],
                    [
                        'title' => 'Filosofi Teras', 
                        'author' => 'Henry Manampiring', 
                        'image' => 'https://ebooks.gramedia.com/ebook-covers/45233/big_covers/ID_FIT2018MTH12.jpg'
                    ],
                ];
            @endphp

            {{-- Card Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                        
                        {{-- Book Image Container --}}
                        <div class="relative aspect-[3/4] mb-5 overflow-hidden rounded-2xl shadow-md group">
                            <img 
                                src="{{ $book['image'] }}" 
                                alt="{{ $book['title'] }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            {{-- Overlay Tipis (Optional) --}}
                            <div class="absolute inset-0 bg-black/5"></div>
                        </div>

                        {{-- Book Info --}}
                        <div class="flex flex-col flex-1">
                            <h3 class="font-bold text-slate-800 text-base mb-1 line-clamp-1">
                                {{ $book['title'] }}
                            </h3>

                            <p class="text-slate-400 text-xs mb-6 italic">
                                {{ $book['author'] }}
                            </p>

                            <button class="w-full mt-auto bg-slate-50 text-slate-600 py-3 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-colors border border-transparent hover:border-blue-600">
                                Pinjam Sekarang
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>

        </section>


        {{-- ================= CTA MEMBERSHIP ================= --}}
        <section class="px-8 pb-20 bg-slate-50/50 mb-6">
            <div class="bg-blue-600 rounded-xl p-12 lg:p-20 text-center text-white relative overflow-hidden shadow-2xl shadow-blue-200">

                <div class="relative z-10">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                        Bergabung Menjadi Anggota Sekarang
                    </h2>

                    <p class="text-blue-100 mb-12 max-w-2xl mx-auto text-lg leading-relaxed opacity-90">
                        Dapatkan akses eksklusif ke koleksi terbaru,
                        fasilitas peminjaman yang lebih fleksibel,
                        dan ruang baca premium kami.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <button class="bg-white text-blue-600 px-10 py-4 rounded-full font-bold text-sm shadow-lg hover:bg-slate-100 transition">
                            Daftar Keanggotaan
                        </button>

                        <button class="border-2 border-white/30 text-white px-10 py-4 rounded-full font-bold text-sm hover:bg-white/10 transition">
                            Pelajari Benefit
                        </button>
                    </div>
                </div>

                {{-- Decorative --}}
                <div class="absolute top-0 right-0 w-80 h-80 bg-blue-500 rounded-full -mr-24 -mt-24 opacity-40 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-400 rounded-full -ml-20 -mb-20 opacity-30 blur-2xl"></div>

            </div>
        </section>

        <footer class="bg-gray-400 pt-20 pb-10 px-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-blue-600 p-1.5 rounded text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="font-bold text-lg uppercase">Pustaka</span>
                </div>
                <p class="text-sm text-slate-500 leading-relaxed">Perpustakaan modern yang menghubungkan pembaca dengan pengetahuan global melalui teknologi digital.</p>
            </div>
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest mb-6">Layanan</h4>
                <ul class="text-sm text-slate-500 space-y-3">
                    <li><a href="#">E-Library</a></li>
                    <li><a href="#">Ruang Belajar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest mb-6">Perusahaan</h4>
                <ul class="text-sm text-slate-500 space-y-3">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Karir</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-xs uppercase tracking-widest mb-6">Hubungi Kami</h4>
                <ul class="text-sm text-slate-500 space-y-3">
                    <li class="flex items-start gap-2 italic">Jl. Perpustakaan Nasional No. 12</li>
                    <li>(021) 123-4567</li>
                </ul>
            </div>
        </div>
        <div class="flex justify-between items-center pt-8 border-t border-slate-100 text-[10px] text-slate-400">
            <p>© 2024 Pustaka Digital Indonesia. Seluruh hak cipta dilindungi.</p>
            <div class="flex gap-4">
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </footer>

    </div>
</body>
</html>

