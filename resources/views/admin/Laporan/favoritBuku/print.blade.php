@extends('printfile')
@section('konten')
    <h3 class="font-semibold text-slate-800 text-2xl">Laporan data buku </h3>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">
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
                    stok
                </th>
                <th scope="col" class="px-6 py-3">
                    Rating
                </th>


            </tr>
        </thead>
        <tbody>
            @foreach ($bukuGalih as $itemGalih)
                <tr class="bg-white border-b :bg-gray-800 :border-gray-700">

                    <td class="py-6 px-3">{{ $itemGalih->judul }}</td>
                    <td class="py-6 px-3">{{ $itemGalih->penulis }}</td>
                    <td class="py-6 px-3">{{ $itemGalih->penerbit }}</td>
                    <td class="py-6 px-3">{{ $itemGalih->tahun_terbit }}</td>
                    <td class="py-6 px-3">{{ $itemGalih->stok }}</td>
                    <td class="py-6 px-3 font-bold">
                        <div class="flex flex-col">
                            <a
                                class=" {{ $itemGalih->avgrating ? 'bg-green-600' : '' }} w-fit text-sm rounded-lg text-white p-2">
                                {{ $itemGalih->avgrating ? number_format($itemGalih->avgrating, 1) . '/5' : '' }}

                            </a>

                        </div>
                    </td>

                </tr>
            @endforeach


        </tbody>
    </table>
@endsection
