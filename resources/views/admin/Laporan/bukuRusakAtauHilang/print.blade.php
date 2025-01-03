@extends('printfile')

@section('konten')
    <div class="relative overflow-x-auto flex justify-center shadow-md w-full sm:rounded-lg">
        <a class="text-2xl mb-6 font-semibold text-slate-800">Data laporan buku hilang</a>
        @php
            $total = 0;
            foreach ($peminjamanGalih as $value) {
                foreach ($value->denda as $denda) {
                    # code...
                    $total += $denda->denda ?? null;
                }
            }

            // dd();

        @endphp

        <a class="text-slate-600 text-2xl font-semibold">Laporan buku rusak atau hilang</a>
        <a class="text-slate-600 text-xl font-semibold">Total akumulasi denda yang ada: <span
                class="text-xl font-bold">{{ $total }}</span></a>

        <table class="w-full  text-sm text-left rtl:text-right text-gray-500 :text-gray-400">



            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>


                    <th scope="col" class="px-2 py-3">
                        Judul buku
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Pengguna bersangkutan
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Penulis
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Penerbit
                    </th>

                    <th scope="col" class="px-2 py-3">
                        Tahun Terbit
                    </th>


                    <th scope="col" class="px-2 py-3">
                        Denda
                    </th>



                </tr>
            </thead>
            <tbody>

                @foreach ($peminjamanGalih as $itemGalih)
                    <tr>


                        <td class="px-6  py-3">
                            {{ $itemGalih->buku->judul }}
                        </td>
                        <td class="px-6  py-3">
                            <a>
                                {{ $itemGalih->user->nama_lengkap }}
                                <br>
                                {{ $itemGalih->user->email }}

                            </a>
                        </td>
                        <td class="px-6  py-3">
                            {{ $itemGalih->buku->penulis }}
                        </td>
                        <td class="px-6  py-3">
                            {{ $itemGalih->buku->penerbit }}
                        </td>
                        <td class="px-6  py-3">
                            {{ $itemGalih->buku->tahun_terbit }}
                        </td>
                        <td class="px-6  py-3">
                            <a class="text-red-500">
                                @php
                                    $hasilDendaGalih = 0;
                                    foreach ($itemGalih->denda as $dendaGalih) {
                                        $hasilDendaGalih += $dendaGalih->denda;
                                    }

                                @endphp
                                RP:{{ $hasilDendaGalih }}
                            </a>
                        </td>

                    </tr>
                @endforeach



            </tbody>
        </table>
    </div>
@endsection
