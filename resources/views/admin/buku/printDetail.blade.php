@extends('printfile')

@section('konten')
    <div class="relative overflow-x-auto shadow-md w-full p-5 mt-4 sm:rounded-lg">


        <div class="flex flex-col  text-base text-left  font-semibold  text-gray-600 bg-white :text-white :bg-gray-800">
            Buku {{ $bukuGalih->judul }}
            <p class=" text-sm font-normal text-gray-500 :text-gray-400">
                Detail pencatatan stok dari buku {{ $bukuGalih->judul }}

            </p>

            <a class="text-slate-600 text-lg font-semibold mt-6">Total stok di buku ini {{ $bukuGalih->stok }} Buku dan total
                Buku Yang di pinjam adalah {{ $GalihTotalPeminjam }}</a>



        </div>

        <table class="w-full mt-6 text-sm text-left rtl:text-right text-gray-500 :text-gray-400">


            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Judul buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stok
                    </th>


                    <th scope="col" class="px-6 py-3">
                        keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status pencatatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        tanggal
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($pencatatanGalih as $itemGalih)
                    <tr>
                        <td class="px-6 py-3">{{ $itemGalih->buku->judul }}</td>
                        <td class="px-6 py-3">{{ $itemGalih->jumlah }}</td>
                        <td class="px-6 py-3">{{ $itemGalih->keterangan }}</td>
                        <td class="px-6 py-3 ">
                            <a
                                class="text-white {{ $itemGalih->status === 'penambahan' ? 'bg-sky-500' : 'bg-red-500' }} py-2 px-2 rounded-lg">{{ $itemGalih->status }}</a>

                        </td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($itemGalih->created_at)->format('d F Y') }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
