@extends('admin.adminLayouts')

@section('konten')
    <div class="relative overflow-x-auto shadow-md w-full sm:rounded-lg">


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white :text-white :bg-gray-800">
                Buku
                <p class="mt-1 text-sm font-normal text-gray-500 :text-gray-400">Pendataan stok buku yang ada di lihblary</p>
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
                    <th scope="col" class="px-6 py-3">
                        sinopsis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        stok
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $itemGalih)
                    @include('admin.buku.modal.edit')

                    <tr class="bg-white border-b relative :bg-gray-800 :border-gray-700">
                        <td>
                            <a href="{{ route('adminBuku.show', $itemGalih->bukuId) }}" class="inset-1 absolute"></a>
                        </td>
                        <td class="px-6 py-4">
                            <img class="w-[5rem] aspect-square object-cover overflow-hidden"
                                src="{{ asset('storage/' . $itemGalih->foto) }}" alt="">
                        </td>
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


                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
