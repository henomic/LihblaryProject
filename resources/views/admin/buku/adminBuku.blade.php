@extends('admin.adminLayouts')

@section('konten')
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
        class="block w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Insert
    </button>


    @include('admin.buku.modal.insert')


    <div class="relative p-2 overflow-x-auto shadow-md w-full sm:rounded-lg">
        <form class="flex mt-6  justify-between ">
            <select name="kategori" class="py-2 px-2 rounded-lg" onchange="this.form.submit()" id="">
                {{-- <option value="">Pilih nama kategori</option> --}}

                @foreach ($kategori as $kat)
                    <option value="">Cari kategori</option>
                    <option {{ Request('kategori') == $kat->kategoriId ? 'selected' : '' }} value="{{ $kat->kategoriId }}">
                        {{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <input class="py-1 rounded-lg" placeholder="Cari nama" name="nama" value="{{ Request('nama') }}"
                    type="text">
                <button class="py-2 px-3 bg-blue-400 text-white rounded-lg">Cari</button>
            </div>
        </form>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white :text-white :bg-gray-800">
                Buku
                <p class="mt-1 text-sm font-normal text-gray-500 :text-gray-400">Browse a list of Flowbite products
                    Pembuatan kategori di tujukan untuk bisa membuat kelompok buku agar lebih effisien saat user mencari</p>
                <div class="flex text-sm text-red-600 flex-col">
                    @foreach ($errors->all() as $galihdata)
                        {{ $galihdata }}
                    @endforeach
                </div>
                <form method="GET" action="" class="w-full gap-3 flex justify-end mt-4">
                    <button name="param" value="buku"
                        class="{{ Request('param') === 'buku' ? 'bg-gray-400' : 'bg-blue-400' }} text-white text-sm py-2 px-4 rounded-md">Buku</button>
                    <button name="param" value="stok"
                        class="{{ Request('param') === 'stok' ? 'bg-gray-400' : 'bg-blue-400' }} text-white text-sm py-2 px-4 rounded-md">Stok</button>

                </form>
            </caption>


            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Judul buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Penulis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Penerbit
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Tahun Terbit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        sinopsis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        stok
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $itemGalih)
                    @include('admin.buku.modal.edit')

                    <tr class="bg-white border-b :bg-gray-800 :border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap :text-white">
                            {{ $itemGalih->judul }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $itemGalih->penulis }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->penerbit }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->tahun_terbit }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->sinopsis }}
                        </td>
                        <td class="px-6  py-4">
                            {{-- {{ $itemGalih->kategori }} --}}
                            <div class="flex gap-2 flex-wrap">
                                @foreach ($itemGalih->kategori as $galihKategori)
                                    <div class="bg-blue-500 rounded-md text-white py-2 px-4">
                                        {{ $galihKategori->nama_kategori }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->stok }}
                        </td>
                        <td class="px-6 py-4">
                            <img class="w-[5rem] aspect-square object-cover overflow-hidden"
                                src="{{ asset('storage/' . $itemGalih->foto) }}" alt="">
                        </td>
                        <td class="px-6 py-4 ">

                            <a data-modal-target="edit{{ $itemGalih->bukuId }}"
                                data-modal-toggle="edit{{ $itemGalih->bukuId }}"
                                class="font-medium text-blue-600 cursor-pointer :text-blue-500 hover:underline">Edit</a>

                            @if ($itemGalih->totalPeminjaman <= 0)
                                <a data-modal-target="hapus{{ $itemGalih->bukuId }}"
                                    data-modal-toggle="hapus{{ $itemGalih->bukuId }}"
                                    class="font-medium cursor-pointer text-red-600 :text-blue-500 hover:underline">Delete</a>
                            @endif
                        </td>
                    </tr>

                    @include('admin.buku.modal.edit')
                    @include('admin.buku.modal.hapusBuku')
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
