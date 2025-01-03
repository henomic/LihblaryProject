<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])`
    {{-- <link rel="stylesheet" href="{{ asset('css/print.css') }}"> --}}
    <style>
        @media print {
            .noPrint {
                display: none !important;
            }
        }
    </style>
</head>

@include('sweetalert::alert')

<body class="">
    {{-- 
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script> --}}


    <div class="flex flex-col min-h-screen">
        <!-- Sidebar -->


        {{-- <nav class="bg-slate-600 text-white w-full py-2 px-4">
            <a class="font-semibold">Admin panel</a>
        </nav> --}}

        <main class="flex">
            <aside class="z-20 print:hidden hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
                <div class="py-4 flex flex-col text-gray-500">
                    <a class="ml-6 text-lg font-bold text-gray-800" href="#">
                        {{ Auth::user()->level === 'admin' ? 'Admin' : 'Petugas' }} Panel


                    </a>


                    <a class="px-6 font-semibold text-sm mt-2">
                        Wellcome ,
                        <br>
                        {{ Auth::user()->nama_lengkap }}

                    </a>
                    <ul class="mt-6">
                        <li class="relative  px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm py-2 px-3 {{ request()->routeIs('AdminDashboard.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                href="{{ route('AdminDashboard.index') }}">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                <span class="ml-4">Dashboard</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm py-2 px-3  {{ request()->routeIs('adminKategori.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                href="{{ route('adminKategori.index') }}">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                <span class="ml-4">Kategori</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm py-2 px-3  {{ request()->routeIs('adminBuku.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                href="{{ route('adminBuku.index') }}">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                <span class="ml-4">Buku</span>
                            </a>
                        </li>

                        <li class="relative px-6 py-3">
                            <a class="inline-flex items-center w-full text-sm py-2 px-3  {{ request()->routeIs('adminKonfirmasiPeminjaman.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                href="{{ route('adminKonfirmasiPeminjaman.index') }}">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                                <span class="ml-4">Peminjaman Buku</span>
                            </a>
                        </li>

                        @if (Auth::user()->level === 'admin')
                            <li class="relative px-6 py-3">
                                <a class="inline-flex items-center w-full text-sm py-2 px-3  {{ request()->routeIs('peminjamBukuConrtol.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                    href="{{ route('peminjamBukuConrtol.index') }}">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span class="ml-4">Peminjam Buku</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->level === 'admin')
                            <li class="relative px-6 py-3">
                                <a class="inline-flex items-center w-full text-sm py-2 px-3  {{ request()->routeIs('adminPetugas.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                    href="{{ route('adminPetugas.index') }}">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span class="ml-4">Petugas dan admin</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->level === 'admin')
                            <li class="relative px-6 py-3">
                                <a class="inline-flex items-center w-full text-sm py-2 px-3  {{ request()->routeIs('activityLog.index') ? 'bg-gray-100' : '' }}  font-semibold transition-colors duration-150 hover:text-gray-800"
                                    href="{{ route('activityLog.index') }}">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                        </path>
                                    </svg>
                                    <span class="ml-4">Rekam Aktivitas</span>
                                </a>
                            </li>
                        @endif
                        <li class="relative px-6 py-3">
                            <a id="parent"
                                class="inline-flex cursor-pointer items-center w-full text-sm py-2 px-3  
                                    {{ request()->routeIs('laporanBukuFavorit.index') ? 'bg-gray-100' : '' }}
                                    {{ request()->routeIs('laporanPeminjamanBuku.index') ? 'bg-gray-100' : '' }}
                                    {{ request()->routeIs('laporanStokBuku.index') ? 'bg-gray-100' : '' }}
                                    {{ request()->routeIs('laporanBukuRusakAtauHilang.index') ? 'bg-gray-100' : '' }}
                                       font-semibold  hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-clipboard-minus">
                                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                    <path
                                        d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                    <path d="M9 14h6" />
                                </svg>
                                <span class="ml-4">Laporan</span>
                            </a>
                            <div id="child"
                                class="flex overflow-hidden max-h-0 gap-2 ease-in-out text-sm bg-gray-100 mt-4 p-0 transition-all duration-1000 rounded-md flex-col">
                                <a href="{{ route('laporanBukuFavorit.index') }}">Buku Favorit</a>
                                <a href="{{ route('laporanPeminjamanBuku.index') }}">Peminjaman buku</a>
                                <a href="{{ route('laporanStokBuku.index') }}">Stok buku</a>
                                <a href="{{ route('laporanBukuRusakAtauHilang.index') }}">Laporan buku
                                    Hilang/Rusak</a>
                            </div>
                        </li>
                    </ul>
                    <div class="px-6 my-6">
                        <form action="{{ route('auth.destroy', Auth::user()->id_user) }}" method="post">
                            @csrf
                            @method('delete')
                            <button
                                class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Logout
                                <span class="ml-2" aria-hidden="true">→</span>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
            <div class="konten flex p-5 flex-col w-full">
                @yield('konten')
            </div>
        </main>
    </div>


    <script>
        document.getElementById('parent').addEventListener('click', function() {
            child = document.getElementById('child');

            if (child.classList.contains('max-h-0')) {
                child.classList.remove('max-h-0');
                child.classList.remove('p-0');
                child.classList.add('p-3');
                child.classList.add('max-h-screen');

            } else {
                child.classList.add('max-h-0');
                child.classList.remove('max-h-screen');
                child.classList.remove('p-3');
                child.classList.add('p-0');
            }
            console.log(child);
        });
    </script>
</body>

</html>
