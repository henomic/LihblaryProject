@extends('admin.adminLayouts')

@section('konten')
    <div class="relative overflow-x-auto shadow-md w-full p-4 sm:rounded-lg">
        <h3 class="text-2xl font-semibold text-slate-600 mb-4">
            Daftar peminjaman buku
        </h3>
        <form action="" method="get" class="flex  justify-between">
            @csrf

            <button name="print" class="bg-blue-500 mb-6 text-white py-2 px-4 rounded-lg">Print</button>

            <select name="urutan" onchange="this.form.submit()" class="rounded-lg h-fit" id="">
                <option value="">Sortir peminjaman</option>
                <option {{ Request('urutan') === 'desc' ? 'selected' : '' }} value="desc">peminjaman Terbanyak</option>
                <option {{ Request('urutan') === 'asc' ? 'selected' : '' }} value="asc">peminjaman paling sedikit</option>
            </select>
        </form>


        <table class="w-full text-sm text-left rtl:text-right  text-gray-500 :text-gray-400">



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
                            <img src="{{ asset('storage/' . $itemGalih->foto) }}"
                                class="w-[5rem] aspect-square overflow-hidden" alt="" srcset="">
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
