@extends('Layouts.landingPageLayouts')

@section('konten')
    <main class="flex-grow">

        <!-- Hero Section -->
        <section class="bg-gray-100 py-20">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Jelajahi Dunia Literasi dari Rumah Anda
                    </h1>
                    <p class="text-xl text-gray-600 mb-6">
                        Akses ribuan buku digital, artikel, dan sumber daya pendidikan lainnya dengan mudah dan cepat.
                    </p>
                    <div class="flex space-x-4">
                        <a href=") }}"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8">Mulai
                            Membaca</a>
                        <a href=") }}"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-11 px-8">Pelajari
                            Lebih Lanjut</a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Fitur Unggulan Kami</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 mx-auto mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">Pencarian Cepat</h3>
                        <p class="text-gray-600">Temukan buku yang Anda cari dengan mudah menggunakan fitur pencarian
                            canggih kami.</p>
                    </div>
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 mx-auto mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">Komunitas Pembaca</h3>
                        <p class="text-gray-600">Bergabung dengan komunitas pembaca untuk berbagi ulasan dan rekomendasi
                            buku.</p>
                    </div>
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 mx-auto mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold mb-2">Akses 24/7</h3>
                        <p class="text-gray-600">Baca kapan saja dan di mana saja dengan akses perpustakaan 24 jam
                            sehari, 7 hari seminggu.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Books Section -->
        <section class="bg-gray-50 py-20">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Koleksi Terbaru</h2>
                <div class="grid md:grid-cols-4 gap-8">
                    @foreach ($buku as $galihBuku)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
                            <a href="{{ route('PeminjamanBuku.show', $galihBuku->bukuId) }}" class="absolute  inset-1"></a>
                            <img src="{{ asset('storage/' . $galihBuku->foto) }}" alt="Book "
                                class="w-full h-64 overflow-hidden object-cover">
                            <div class="p-4">

                                <div class="flex flex-wrap gap-1">
                                    @foreach ($galihBuku->kategori as $dataKategoriGalih)
                                        <p class="text-white bg-blue-500 px-2 py-1 rounded-lg text-sm mb-2">
                                            {{ $dataKategoriGalih->nama_kategori }}
                                        </p>
                                    @endforeach
                                </div>

                                <h3 class="text-lg font-semibold mb-2">{{ $galihBuku->judul }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $galihBuku->penulis }}</p>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 mr-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">
                                        @php
                                            $ulasanBukuGalih = 0;
                                            foreach ($galihBuku->ulasan as $ulasanGalih) {
                                                $ulasanBukuGalih = $ulasanGalih
                                                    ->where('bukuId', $galihBuku->bukuId)
                                                    ->avg('rating');
                                            }
                                        @endphp
                                        {{ number_format($ulasanBukuGalih, 1) }}/5
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <a href="{{ route('bukufilter.index') }}"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">Lihat
                        Semua Buku</a>
                </div>
            </div>
        </section>

        <div id="aturan" class="w-full p-5 flex justify-center">
            <div class="bg-white p-8 rounded-lg shadow-md  container w-full">
                <h1 class="text-3xl font-bold mb-6 text-center text-purple-600">Aturan Perpustakaan Lihblary</h1>
                <ul class="space-y-6">
                    <li class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-4 mt-1"></i>
                        <span>
                            <strong class="text-lg">Jangan menghilangkan atau merusak buku:</strong>
                            <ul class="list-disc list-inside ml-4 mt-2">
                                <li>Pelanggaran akan dikenakan denda</li>
                                <li>Jika melakukan 5 kali, akun akan di-banned</li>
                            </ul>
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-clock text-yellow-500 mr-4 mt-1"></i>
                        <span>
                            <strong class="text-lg">Keterlambatan pengembalian buku:</strong>
                            <p class="mt-2">Denda Rp 20.000 per hari</p>
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-calendar-times text-purple-500 mr-4 mt-1"></i>
                        <span>
                            <strong class="text-lg">Batas waktu pengambilan buku:</strong>
                            <p class="mt-2">Maksimal 3 hari setelah pembookingan. Jika melebihi, peminjaman akan ditolak.
                            </p>
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-book text-green-500 mr-4 mt-1"></i>
                        <span>
                            <strong class="text-lg">Peminjaman buku:</strong>
                            <p class="mt-2">Disarankan untuk meminjam buku pada hari yang sama dengan pembookingan untuk
                                menghindari
                                kehabisan stok.</p>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Testimonial Section -->
        {{-- <section class="py-20">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Apa Kata Pembaca Kami</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <p class="text-gray-600 mb-4">
                                "LibroLine telah mengubah cara saya membaca. Akses ke berbagai buku dan kemudahan
                                penggunaannya luar biasa!"
                            </p>
                            <div class="flex items-center">
                                <img src="{{ asset('images/user-' . $i . '.jpg') }}" alt="User {{ $i }}"
                                    class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <p class="font-semibold">Pengguna {{ $i }}</p>
                                    <p class="text-sm text-gray-500">Pembaca Aktif</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section> --}}

        <!-- CTA Section -->
        @if (!Auth::check())
            <section class="bg-blue-600 py-20">
                <div class="container mx-auto px-4 text-center">
                    <h2 class="text-3xl font-bold text-white mb-4">Siap untuk Mulai Membaca?</h2>
                    <p class="text-xl text-blue-100 mb-8">Bergabunglah dengan ribuan pembaca dan mulai petualangan literasi
                        Anda hari ini.</p>
                    <a href="{{ route('auth.create') }}"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground hover:bg-secondary/80 h-11 px-8">Daftar
                        Sekarang - Gratis!</a>
                </div>
            </section>
        @endif
    </main>
@endsection
