@extends('printfile')

@section('konten')
    <div class="relative overflow-x-auto shadow-md w-full sm:rounded-lg">
        <h3 class="font-semibold text-slate-800 text-2xl">Laporan buku peminjaman terbanyak</h3>


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
                        Total peminjaman
                    </th>



                </tr>
            </thead>
            <tbody>

                @foreach ($bukuGalih as $itemGalih)
                    <tr>
                        <td class="px-6 py-3">
                            <img src="{{ public_path('storage/' . $itemGalih->foto) }}"
                                class="w-12- aspect-square overflow-hidden" alt="" srcset="">
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
                            {{ $itemGalih->peminjamanBuku }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
