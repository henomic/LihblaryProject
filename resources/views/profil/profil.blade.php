@php
    $extend = 'Layouts.landingPageLayouts';
    if (Auth::user()->level === 'admin') {
        $extend = 'admin.adminLayouts';
    }

@endphp
@extends($extend)

@section('konten')
    <div class="">
        <div class="bg-white w-full py-4 rounded-lg overflow-hidden">
            <!-- Cover Photo -->
            <div class="h-48 bg-cover bg-center bg-blue-500"
                style="background-image: url('/placeholder.svg?height=192&width=768')">
            </div>



            <!-- Profile Info -->
            <div class="relative px-4 flex flex-col py-6">
                <div class="-mt-16 ">
                    <img class="w-32 h-32 rounded-full border-4 border-white shadow-lg"
                        src="{{ asset('storage/' . $galih_user->foto) }}" alt="John Doe">
                </div>
                <div class="mt-4 ml-2">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $galih_user->nama_lengkap }}</h1>
                    <p class="mt-2 text-gray-600">{{ $galih_user->username }}</p>
                </div>

            </div>

            <div class="flex border-b">
                <form action="{{ route('profil.show', $galih_user->id_user) }}" method="post">
                    @csrf
                    @method('get')
                    <button name="param" value="profil"
                        class="px-4 py-2 {{ $param === 'profil' ? 'text-blue-500 border-b-2 border-blue-500' : ' text-gray-600 font-semibold hover:text-blue-500' }}">Profile</button>
                    <button name="param" value="riwayat"
                        class="px-4 py-2 {{ $param === 'riwayat' ? 'text-blue-500 border-b-2 border-blue-500' : ' text-gray-600 font-semibold hover:text-blue-500' }}">Riwayat
                        peminjaman</button>
                </form>
            </div>

            @if ($param === 'profil')
                <div class="px-6 mt-6 flex flex-col items-center justify-center">

                    <div class="w-full flex flex-col justify-start">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tentang akun
                            {{ Auth::user()->id_user === $galih_user->id_user ? 'Saya' : 'ini' }}</h2>
                        <p class="text-gray-600 mb-6">
                            Akun ini di buat pada {{ $galih_user->created_at->format('d F Y') }}

                        </p>
                    </div>

                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('auth.update', $galih_user->id_user) }}"
                        class="flex container flex-col mt-14 gap-6">
                        @csrf
                        @method('put')

                        <h2 class="text-2xl font-semibold w-full  text-gray-800 mb-4">Profile</h2>

                        <div class="text-red-500 flex flex-col">
                            @foreach ($errors->all() as $item)
                                {{ $item }}
                            @endforeach
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    lengkap</label>
                                <input required {{ $galih_user->id_user === Auth::user()->id_user ? '' : 'disabled' }}
                                    type="text" name="nama" id="nama" value="{{ $galih_user->nama_lengkap }}"
                                    class="w-full px-3 py-2 border {{ $galih_user->id === Auth::user()->id ? 'border-slate-300' : 'border-slate-100' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input required {{ $galih_user->id_user === Auth::user()->id_user ? '' : 'disabled' }}
                                    type="email" name="email" id="email" value="{{ $galih_user->email }}"
                                    class="w-full px-3 py-2 border {{ $galih_user->id === Auth::user()->id ? 'border-slate-300' : 'border-slate-100' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>


                        </div>
                        @if (Auth::user()->level === 'admin' or $galih_user->id_user === Auth::user()->id_user)
                            <div>
                                <label for="name"
                                    class=" flex flex-col w-full text-sm font-medium text-gray-700 mb-1">Nik</label>
                                <input disabled type="text" name="alamat" id="email" value="{{ $galih_user->nik }}"
                                    class="w-full px-3 py-2 border border-slate-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        @endif
                        <div>
                            <label for="name"
                                class=" flex flex-col w-full text-sm font-medium text-gray-700 mb-1">alamat</label>
                            <input required {{ $galih_user->id_user === Auth::user()->id_user ? '' : 'disabled' }}
                                type="text" name="alamat" id="email" value="{{ $galih_user->alamat }}"
                                class="w-full px-3 py-2 border {{ $galih_user->id_user === Auth::user()->id_user ? 'border-slate-300' : 'border-slate-100' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="name"
                                class=" flex flex-col w-full text-sm font-medium text-gray-700 mb-1">username</label>
                            <input required {{ $galih_user->id_user === Auth::user()->id_user ? '' : 'disabled' }}
                                type="text" name="username" id="email" value="{{ $galih_user->username }}"
                                class="w-full px-3 py-2 border {{ $galih_user->id_user === Auth::user()->id_user ? 'border-slate-300' : 'border-slate-100' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @if (Auth::user()->id_user === $galih_user->id_user)
                            <div>
                                <label for="name"
                                    class=" flex flex-col w-full text-sm font-medium text-gray-700 mb-1">foto</label>
                                <input {{ $galih_user->id_user === Auth::user()->id_user ? '' : 'disabled' }}
                                    type="file" name="foto" id="email"
                                    class="w-full px-3 py-2 border {{ $galih_user->id_user === Auth::user()->id_user ? 'border-slate-300' : 'border-slate-100' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Update Profile
                                </button>
                            </div>
                        @endif

                    </form>
                </div>
            @else
                <div class="min-h-[20rem]">

                    @forelse ($peminjamGalih as $itemGalih)
                        <div class="flex mt-4 items-center px-4 py-4 relative sm:px-6">

                            <a href="{{ route('detailPeminjaman', $itemGalih->peminjamanId) }}"
                                class="inset-1 absolute"></a>
                            <div class="flex min-w-0 flex-1 items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-md"
                                        src="{{ asset('storage/' . $itemGalih->buku->foto) }}" alt="Sampul buku" />
                                </div>
                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                    <div>
                                        <p class="truncate text-sm md:text-base font-medium text-indigo-600">
                                            {{ $itemGalih->buku->judul }}
                                        </p>
                                        <p class="mt-2 flex items-center text-sm md:text-base text-gray-500">
                                            <span class="truncate">{{ $itemGalih->buku->penulis }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="">
                                        <div class="flex flex-col justify-center">
                                            @if ($itemGalih->status === 'booking' or $itemGalih->status === 'dipinjam')
                                                <p class="text-sm md:text-base text-gray-900">
                                                    Dipinjam pada
                                                    <time
                                                        datetime="{{ $itemGalih->tanggalPeminjaman }}">{{ \Carbon\Carbon::parse($itemGalih->tanggalPeminjaman)->format('d F , Y') }}</time>
                                                </p>
                                                @php
                                                    $peminjamanGalihDiff = \Carbon\Carbon::now()->diffInDays(
                                                        \Carbon\Carbon::parse($itemGalih->tanggalPengembalian),
                                                    );
                                                    $peminjamanGalihDiff = round($peminjamanGalihDiff);
                                                @endphp
                                                <p
                                                    class="mt-2 flex {{ $peminjamanGalihDiff < 0 ? 'text-red-700' : 'text-gray-500' }} items-center text-sm md:text-base ">
                                                    Jatuh tempo:
                                                    {{ \Carbon\Carbon::parse($itemGalih->tanggalPengembalian)->format('d F, Y') }}
                                                    ({{ abs($peminjamanGalihDiff) . ' ' }}{{ $peminjamanGalihDiff < 0 ? ' hari sudah  lewat' : 'Hari lagi' }})
                                                    {{-- ({{ $galihwaktu = \Carbon\Carbon::parse($itemGalih->tanggalPengembalian)->diffForHumans(\Carbon\Carbon::now()->format('Y-m-d'), ['syntax' => \Carbon\Carbon::DIFF_RELATIVE_TO_NOW]) }}) --}}
                                                </p>
                                            @elseif ($itemGalih->status === 'proses')
                                                <p class="text-slate-700 font-semibold ">Buku anda sedang dalam proses
                                                    sesuai waktu ketentuan (Jika buku habis itu di luar tanggung jawab
                                                    kami)</p>
                                            @elseif ($itemGalih->status === 'dikembalikan')
                                                <p class=" flex flex-col ">
                                                    Buku telah di kembalikan

                                                    @php
                                                        $datadendaGalih = 0;
                                                        foreach ($itemGalih->denda as $dendaGalih) {
                                                            $datadendaGalih += $dendaGalih->denda;
                                                        }
                                                    @endphp
                                                    <a class="text-red-500 {{ $datadendaGalih > 0 ? 'flex' : 'hidden' }}">dengan
                                                        denda sebesar RP: <span
                                                            class="text-semibold">{{ $datadendaGalih }}</span></a>
                                                </p>
                                            @elseif ($itemGalih->status === 'hilang/rusak')
                                                <p class=" flex flex-col ">
                                                    Buku hilang

                                                    @php
                                                        $datadendaGalih = 0;
                                                        foreach ($itemGalih->denda as $dendaGalih) {
                                                            $datadendaGalih += $dendaGalih->denda;
                                                        }
                                                    @endphp
                                                    <a class="text-red-500 {{ $datadendaGalih > 0 ? 'flex' : 'hidden' }}">dengan
                                                        denda sebesar RP: <span
                                                            class="text-semibold">{{ $datadendaGalih }}</span></a>
                                                </p>
                                            @elseif ($itemGalih->status === 'kehabisan')
                                                <p class="text-red-600 ">Maaf buku anda sudah habis saat ini
                                                    mohon untuk memilih buku lain</p>
                                            @elseif ($itemGalih->status === 'tolak')
                                                <p class="text-red-600  ">Permintaan peminjaman anda di tolak karna
                                                    melanggar ketentuan peminjaman perpustakaan</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                    @empty
                        <a href="">untuk peminjaman sekarang anda belum meminjam apa apa segera meminjam buku yang
                            anda inginkan sekarang</a>
                    @endforelse

                </div>
            @endif

        </div>
    </div>
@endsection
