@extends('printfile')

@section('konten')
    <div class="relative overflow-x-auto shadow-md w-full sm:rounded-lg">
        <h3 class="text-2xl font-semibold text-slate-600 mb-4">
            Daftar stok buku
        </h3>


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">



            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Foto buku
                    </th>
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
                        Tahun terbit
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Stok buku
                    </th>



                </tr>
            </thead>
            <tbody>

                @foreach ($stokBukuGalih as $itemGalih)
                    <tr class="{{ $itemGalih->stok <= 5 ? 'bg-red-100' : '' }}">
                        <td class="px-6 py-3">
                            <img src="{{ public_path('storage/' . $itemGalih->foto) }}"
                                class="w-12 aspect-square overflow-hidden" alt="" srcset="">
                        </td>
                        <td class="px-6 py-3">
                            {{ $itemGalih->judul }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $itemGalih->penulis }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $itemGalih->penerbit }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $itemGalih->tahun_terbit }}
                        </td>

                        <td class="px-6 py-3">
                            <a
                                class="text-white py-2 px-3 {{ $itemGalih->stok <= 5 ? 'bg-red-400' : 'bg-blue-400' }} rounded-lg">
                                {{ $itemGalih->stok }}
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
