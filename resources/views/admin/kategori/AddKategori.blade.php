@extends('admin.adminLayouts')

@section('konten')
    <div class="flex justify-between w-full">

        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Insert
        </button>


        <form class="flex gap-2">
            <input class="py-1 rounded-lg" name="nama" value="{{ Request('nama') }}" type="text">
            <button class="py-2 px-3 bg-blue-400 text-white rounded-lg">Cari</button>
        </form>
    </div>

    @include('admin.kategori.modal.insert')


    <div class="relative overflow-x-auto shadow-md w-full sm:rounded-lg">


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white :text-white :bg-gray-800">
                Kategori
                <p class="mt-1 text-sm font-normal text-gray-500 :text-gray-400">Browse a list of Flowbite products
                    Pembuatan kategori di tujukan untuk bisa membuat kelompok buku agar lebih effisien saat user mencari</p>
                <div class="flex text-sm text-red-600 flex-col">
                    @foreach ($errors->all() as $dataGalih)
                        {{ $dataGalih }}
                    @endforeach
                </div>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal pembuatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($Galih_kategori as $itemGalih)
                    <tr class="bg-white border-b :bg-gray-800 :border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap :text-white">
                            {{ $itemGalih->nama_kategori }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $itemGalih->bukuCount }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 ">
                            <a data-modal-target="edit{{ $itemGalih->kategoriId }}"
                                data-modal-toggle="edit{{ $itemGalih->kategoriId }}"
                                class="font-medium text-blue-600 cursor-pointer :text-blue-500 hover:underline">Edit</a>
                            @if ($itemGalih->bukuCount <= 0)
                                <a data-modal-target="hapus{{ $itemGalih->kategoriId }}"
                                    data-modal-toggle="hapus{{ $itemGalih->kategoriId }}"
                                    class="font-medium
                                    cursor-pointer text-red-600 :text-blue-500 hover:underline">Delete</a>
                            @endif
                        </td>
                    </tr>

                    @include('admin.kategori.modal.editModal')
                    @include('admin.kategori.modal.hapus')
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
