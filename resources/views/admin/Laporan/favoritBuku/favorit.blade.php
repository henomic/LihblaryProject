@extends('admin.adminLayouts')

@section('konten')
    <div class="relative   overflow-x-auto shadow-md w-full sm:rounded-lg">
        <form method="get" action="" class="flex justify-between gap-2 mb-4">
            @csrf

            <button class="bg-blue-500 text-white py-1 px-4 rounded-md" name="print">Print</button>

            <select name="param" id="" onchange="this.form.submit()" class="rounded-lg ">
                <option value="">Pemilihan rating</option>
                <option {{ Request('param') == 'desc' ? 'selected' : '' }} value="desc">Rating tertinggi</option>
                <option {{ Request('param') == 'asc' ? 'selected' : '' }} value="asc">Rating terendah</option>
            </select>
        </form>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">



            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>
                    <th scope="col" class="px-6 print:hidden py-3">
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
                        Tahun Terbit
                    </th>
                    <th scope="col" class="px-6 print:hidden py-3">
                        Kategori
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
                        <td class="py-6 print:hidden px-3"><img src="{{ asset('storage/' . $itemGalih->foto) }}"
                                class="w-[5rem] aspect-square overflow-hidden" alt="" srcset=""></td>
                        <td class="py-6 px-3">{{ $itemGalih->judul }}</td>
                        <td class="py-6 px-3">{{ $itemGalih->penulis }}</td>
                        <td class="py-6 px-3">{{ $itemGalih->penerbit }}</td>
                        <td class="py-6 px-3">{{ $itemGalih->tahun_terbit }}</td>
                        <td class="py-6 print:hidden px-3">
                            @foreach ($itemGalih->kategori as $katGalih)
                                <a class="bg-blue-500 text-white py-2 rounded-lg px-4">{{ $katGalih->nama_kategori }}</a>
                            @endforeach
                        </td>
                        <td class="py-6 px-3">{{ $itemGalih->stok }}</td>
                        <td class="py-6 px-3 font-bold">
                            <div class="flex flex-col">
                                <a
                                    class="{{ $itemGalih->avgrating ? 'bg-green-600' : 'bg-gray-400' }} w-fit rounded-lg text-white p-2">
                                    {{ $itemGalih->avgrating ? number_format($itemGalih->avgrating, 1) . '/5' : 'belum ada rating' }}

                                </a>
                                <a class="text-sm mt-2 font-normal  {{ $itemGalih->total === 0 ? 'hidden' : '' }}">
                                    penilaian dari {{ $itemGalih->total }} pengguna

                                </a>
                            </div>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
        {{ $bukuGalih->links() }}

    </div>
@endsection
