@extends('admin.adminLayouts')

@section('konten')
    <style>
        .noscrollbar::-webkit-scrollbar-button {
            display: none
        }
    </style>
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
        class="block w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800"
        type="button">
        Insert
    </button>




    <div class="relative   w-full sm:rounded-lg">



        <div class="relative min-h-screen   sm:rounded-lg">
            <div
                class="flex items-center  gap-2   justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white :bg-gray-900">


                <form class="flex  items-center  justify-between ">
                    <div class="flex gap-2">
                        <input value="{{ Request('date1') }}" onchange="this.form.submit()" name="date1" class="rounded-lg"
                            type="date">
                        <input value="{{ Request('date2') }}" onchange="this.form.submit()" name="date2"
                            class="rounded-lg" type="date">
                    </div>

                </form>
                <form class="relative flex items-center">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 :text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input oninput="this.form.submit()" value='{{ Request('kode') }}' name="kode" type="text"
                        id="table-search-users"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500"
                        placeholder="Cari kode peminjaman">
                </form>



            </div>
            <table class="w-full noscrollbar text-sm text-left rtl:text-right text-gray-500 :text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            kode peminjaman
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal peminjaman
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal pengembalian
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galihPeminjaman as $itemGalih)
                        @if ($itemGalih->status === 'dipinjam')
                            @php

                                $diffGalih = \Carbon\Carbon::now()->diffInDays(
                                    \Carbon\Carbon::parse($itemGalih->tanggalPengembalian),
                                );
                                $diffGalih = round($diffGalih);

                            @endphp
                        @endif

                        <tr
                            class=" relative    {{ $itemGalih->status === 'dipinjam' ? ($diffGalih < 0 ? 'bg-red-200' : 'hover:bg-gray-50 ') : '' }}  border-b    ">
                            <td>
                                <a href="{{ route('detailPeminjaman', $itemGalih->peminjamanId) }}"
                                    class="inset-1 absolute "></a>
                            </td>
                            <th scope="row"
                                class="flex relative items-center px-6 py-4 text-gray-900 whitespace-nowrap :text-white">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $itemGalih->user->foto) }}"
                                    alt="Jese image">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $itemGalih->user->nama_lengkap }}</div>
                                    <div class="font-normal text-gray-500">{{ $itemGalih->user->username }}</div>
                                </div>




                            </th>
                            <td class="px-6 relative py-4">
                                {{ $itemGalih->peminjamanId }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $itemGalih->buku->judul }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $itemGalih->tanggalPeminjaman }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    {{ $itemGalih->tanggalPengembalian }}
                                    @if ($itemGalih->status === 'booking' or $itemGalih->status === 'dipinjam')
                                        @php

                                            $diffGalih = \Carbon\Carbon::now()->diffInDays(
                                                \Carbon\Carbon::parse($itemGalih->tanggalPengembalian),
                                            );
                                            $diffGalih = round($diffGalih);

                                        @endphp

                                        <a class="text-red-600 ">{{ $diffGalih < 0 ? 'Terlambat ' . abs($diffGalih) . ' hari' : $diffGalih . ' Tersisa waktu' }}
                                        </a>
                                    @endif
                                </div>

                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <a
                                        class="text-base {{ $itemGalih->status === 'dikembalikan' ? 'bg-blue-500 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        {{ $itemGalih->status === 'proses' ? 'bg-gray-600 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        {{ $itemGalih->status === 'dipinjam' ? 'bg-gray-400 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        {{ $itemGalih->status === 'booking' ? 'bg-green-400 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        {{ $itemGalih->status === 'tolak' ? 'bg-red-600 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        {{ $itemGalih->status === 'hilang/rusak' ? 'bg-red-600 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        {{ $itemGalih->status === 'kehabisan' ? 'bg-red-400 flex justify-center w-fit py-1 px-3 rounded-md text-white ' : '' }}
                                        ">{{ $itemGalih->status }}</a>
                                    {{-- {{ $itemGalih->user->denda }} --}}
                                    @php
                                        $totalDendaGalih = 0;

                                    @endphp
                                    @foreach ($itemGalih->denda as $itemDendaGalih)
                                        @php
                                            $totalDendaGalih += $itemDendaGalih->denda;
                                        @endphp
                                    @endforeach
                                    <a class="text-red-600  mt-1 w-fit {{ $totalDendaGalih > 0 ? 'flex' : 'hidden' }}">Denda
                                        {{ $totalDendaGalih }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 relative">
                                @if ($itemGalih->status === 'booking')
                                    <div class="flex gap-4">
                                        <button data-modal-target="konfirmasi{{ $itemGalih->peminjamanId }}"
                                            data-modal-toggle="konfirmasi{{ $itemGalih->peminjamanId }}"
                                            class="bg-blue-600 text-white py-2 px-4">Konfirmasi</button>
                                        <button data-modal-target="tolak{{ $itemGalih->peminjamanId }}"
                                            data-modal-toggle="tolak{{ $itemGalih->peminjamanId }}"
                                            class="bg-red-600 text-white py-2 px-4">Tolak</button>
                                    </div>
                                @endif
                                @if ($itemGalih->status === 'dipinjam')
                                    <div class="flex gap-4">
                                        <button data-modal-target="konfirmasi{{ $itemGalih->peminjamanId }}"
                                            data-modal-toggle="konfirmasi{{ $itemGalih->peminjamanId }}"
                                            class="bg-blue-600 text-white py-2 px-4">Dikembalikan Dengan aman</button>

                                        <button data-modal-target="tolak{{ $itemGalih->peminjamanId }}"
                                            data-modal-toggle="tolak{{ $itemGalih->peminjamanId }}"
                                            class="bg-red-600 text-white py-2 px-4">Denda (Rusak)</button>
                                    </div>
                                @endif
                                @if ($itemGalih->status === 'kehabisan')
                                    <div class="flex gap-4">
                                        <a class="text-red-600 ">Tidak ada aksi</a>
                                    </div>
                                @endif

                            </td>
                        </tr>

                        @include('admin.peminjaman.modal.konfirmasi')
                        @include('admin.peminjaman.modal.insertPeminjam')
                        @include('admin.peminjaman.modal.tolak')
                    @endforeach

                </tbody>
            </table>

            {{ $galihPeminjaman->links() }}
        </div>

    </div>
    <script>
        console.log('denda');

        textDenda = document.querySelectorAll('.denda').forEach(d => {
            d.addEventListener('keyup', function() {
                denda = this.value;
                console.log(denda);

                if (denda < 0) {
                    this.value = 0;
                }

            });
        });

        // console.log(textDenda);
    </script>
@endsection
