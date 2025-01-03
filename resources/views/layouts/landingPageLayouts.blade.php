<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihblary - Perpustakaan Online</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen">
    @include('sweetalert::alert')

    <header class="bg-white shadow-sm">
        <div class=" mx-auto px-4 py-4 flex justify-between items-center">
            <a href="" class="flex items-center space-x-2 text-purple-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-book-open-text">
                    <path d="M12 7v14" />
                    <path d="M16 12h2" />
                    <path d="M16 8h2" />
                    <path
                        d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z" />
                    <path d="M6 12h2" />
                    <path d="M6 8h2" />
                </svg>
                <span class="text-xl font-bold text-gray-800">Lihblary</span>
            </a>
            <nav class="hidden md:flex space-x-4">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600">Beranda</a>
                <a href="{{ route('bukufilter.index') }}" class="text-gray-600 hover:text-blue-600">Koleksi buku </a>
                @if (Auth::check())
                    <a href="{{ route('viewFavorit', Auth::user()->id_user) }}"
                        class="text-gray-600 hover:text-blue-600">Favorit saya</a>
                    {{-- <a href="{{ route('viewFavorit', Auth::user()->id_user) }}"
                        class="text-gray-600 hover:text-blue-600">Buku yang saya pinjam</a> --}}
                @endif
                {{-- <a href="" class="text-gray-600 hover:text-blue-600">Tentang</a> --}}
                <a href="#aturan" class="text-gray-600 hover:text-blue-600">Aturan kami</a>
            </nav>
            <div class="flex ">
                {{-- {{ Auth::user()->nama_lengkap }} --}}
                @if (Auth::check())
                    <div class="flex profil cursor-pointer items-center gap-2">
                        <a class="text-slate-600 font-semibold text-sm">{{ Auth::user()->nama_lengkap }}</a>
                        <img class="w-8 rounded-full aspect-square" src="{{ asset('storage/' . Auth::user()->foto) }}"
                            alt="" srcset="">
                    </div>
                @else
                    <a href="{{ route('auth.index') }}"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">Masuk</a>
                    <a href="{{ route('auth.create') }}"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">Daftar</a>
                @endif


            </div>


        </div>
        {{-- {{ Auth::user()->id_user }} --}}
        @if (Auth::check())
            <div id="menu" class="bg-white z-20  hidden flex-col py-2 px-4 right-5 absolute gap-2">
                <a href="{{ route('profil.show', Auth::user()->id_user) }}"
                    class="text-base font-semibold text-slate-600">Profile</a>
                <form action="{{ route('auth.destroy', Auth::user()->id_user) }}" method="post">
                    @csrf
                    @method('delete')
                    <button href="" class="text-base font-semibold text-slate-600">Log put</button>
                </form>
            </div>
        @endif
    </header>

    <script>
        document.querySelectorAll('.profil').forEach(element => {
            element.addEventListener('click', function() {
                menu = document.getElementById('menu');
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                } else {
                    menu.classList.add('hidden');
                    menu.classList.remove('flex');
                }
            });
        });
    </script>

    @yield('konten')

    <footer class="bg-gray-800 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tentang LibroLine</h3>
                    <p class="text-gray-400">Misi kami adalah menyediakan akses mudah ke pengetahuan dan literatur
                        untuk semua orang.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="" class="text-gray-400 hover:text-white">Koleksi</a>
                        </li>
                        {{-- <li><a href="{{ route('aturan') }}" class="text-gray-400 hover:text-white"></a> --}}
                        </li>

                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <p class="text-gray-400">Email: info@lihbralycom</p>
                    <p class="text-gray-400">Telepon: 065720172658</p>
                </div>

            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Lihblary. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>


</body>

</html>
