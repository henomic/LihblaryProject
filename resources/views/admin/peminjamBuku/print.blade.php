<div class="min-h-full">
    @extends('printfile')
    @section('konten')

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Detail Peminjaman</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Peminjaman</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail lengkap peminjaman buku.</p>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Kode peminjaman</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <span
                                        class="inline-flex items-center rounded-full  px-2.5 py-0.5 text-sm font-medium text-slate-600">
                                        {{ $DetailPeminjamanGalih->peminjamanId }}
                                    </span>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Status Peminjaman</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        {{ $DetailPeminjamanGalih->status }}
                                    </span>
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Tanggal Peminjaman</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    {{ \Carbon\Carbon::parse($DetailPeminjamanGalih->tanggalPeminjaman)->format('d F Y') }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Jatuh tempo</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    {{ \Carbon\Carbon::parse($DetailPeminjamanGalih->tanggalPengembalian)->format('d F Y') }}
                                </dd>
                            </div>
                            @if ($DetailPeminjamanGalih->status === 'hilang/rusak' or $DetailPeminjamanGalih->status === 'dikembalikan')
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Pengembalian</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ \Carbon\Carbon::parse($DetailPeminjamanGalih->updated_at)->format('d F Y') }}
                                    </dd>
                                </div>

                                @php
                                    $dendaGalih = 0;
                                    foreach ($DetailPeminjamanGalih->denda as $dendaLih) {
                                        $dendaGalih += $dendaLih->denda;
                                    }

                                @endphp
                                @if ($dendaGalih > 0)
                                    <div class="text-red-800 px-4 py-5 sm:grid sm:grid-cols-3 bg-red-100 sm:gap-4 sm:px-6">
                                        <dt class="text-base  font-semibold">Denda</dt>
                                        <dd class="mt-1 font-semibold sm:col-span-2 sm:mt-0">RP:{{ $dendaGalih }}
                                        </dd>

                                        <div class="mt-6 p-5 rounded-lg mr-3 w-full  bg-red-200">
                                            <a>Detail denda</a>
                                            @foreach ($DetailPeminjamanGalih->denda as $dendaLihDetail)
                                                <div class="flex mt-2 gap-6 min-w-[8rem] justify-between ">
                                                    <a>
                                                        {{ $dendaLihDetail->keterangan }}
                                                    </a>
                                                    <a>
                                                        {{ $dendaLihDetail->denda }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Nama Buku</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    {{ $DetailPeminjamanGalih->buku->judul }}
                                </dd>
                            </div>

                        </dl>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
