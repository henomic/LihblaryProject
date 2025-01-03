@extends('admin.adminLayouts')

@section('konten')
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

    <form action="{{ route('laporanBukuRusakAtauHilang.index') }}" class="mt-6" method="GET">

        <button name="print" class="bg-blue-400 text-white py-2 px-4 rounded-lg mb-4">Print</button>
    </form>



    <form class="flex mt-6  justify-between ">
        <div class="flex gap-2">
            <input value="{{ Request('date1') }}" onchange="this.form.submit()" name="date1" class="rounded-lg"
                type="date">
            <input value="{{ Request('date2') }}" onchange="this.form.submit()" name="date2" class="rounded-lg"
                type="date">
        </div>

    </form>



    <div class="relative overflow-x-auto shadow-md w-full sm:rounded-lg">


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">



            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>
                    <th class="relative">

                    </th>
                    <th scope="col" class="px-6 py-3">
                        Foto buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Judul buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pengguna bersangkutan
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
                        Denda
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal denda
                    </th>



                </tr>
            </thead>
            <tbody>

                @foreach ($peminjamanGalih as $itemGalih)
                    <tr>
                        <td>
                            <a href="{{ route('detailPeminjaman', $itemGalih->peminjamanId) }}"
                                class="absolute inset-1 "></a>
                        </td>
                        <td class="px-6  py-3">
                            <img src="{{ asset('storage/' . $itemGalih->buku->foto) }}" class="w-[5rem] aspect-square"
                                alt="" srcset="">
                        </td>
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
                        <td class="px-6  py-3">
                            {{ \Carbon\Carbon::parse($itemGalih->created_at)->format('d F Y') }}
                        </td>

                    </tr>
                @endforeach



            </tbody>
        </table>
    </div>
@endsection
