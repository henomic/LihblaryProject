@extends('admin.adminLayouts')

@section('konten')
    <div class="flex flex-col">
        <a class="text-xl font-semibold text-slate-600">Data Petugas dan admin yang sudah daftar</a>
        <a data-modal-target="insert" data-modal-toggle="insert"
            class="text-white bg-blue-500 rounded-md py-2 px-4 w-fit mt-6 cursor-pointer">Tambah data</a>
        <form class="flex mt-6  justify-between ">
            <select name="status" onchange="this.form.submit()" class="py-2 px-2 rounded-lg" onchange="this.form.submit()"
                id="">
                {{-- <option value="">Pilih nama kategori</option> --}}

                <option value="">Cari status</option>
                <option {{ Request('status') == 'aktif' ? 'selected' : '' }} value="aktif">Aktif</option>
                <option {{ Request('status') == 'nonaktif' ? 'selected' : '' }} value="nonaktif">nonAktif</option>
            </select>
            <div class="flex gap-2">
                <input class="py-1 rounded-lg" placeholder="Cari nama" name="nama" value="{{ Request('nama') }}"
                    type="text">
                <button class="py-2 px-3 bg-blue-400 text-white rounded-lg">Cari</button>
            </div>
        </form>

        @include('admin.petugas.modal.insert')


        <table class="w-full noscrollbar text-sm text-left rtl:text-right text-gray-500 mt-6 :text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nik
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userGalih as $itemGalih)
                    <tr class="bg-white  border-b :bg-gray-800 :border-gray-700  :hover:bg-gray-600">


                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap :text-white">
                            <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $itemGalih->foto) }}"
                                alt="Jese image">
                            <div class="ps-3">
                                {{ $itemGalih->nama_lengkap }}
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $itemGalih->alamat }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->nik }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->level }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->status }}

                        </td>
                        <td class="px-6 py-4">

                            <div class="flex">
                                <a data-modal-target="status{{ $itemGalih->id_user }}"
                                    data-modal-toggle="status{{ $itemGalih->id_user }}"
                                    class="{{ $itemGalih->status === 'aktif' ? 'bg-red-500' : 'bg-blue-500' }} cursor-pointer text-white py-2 px-4 rounded-md w-fit">{{ $itemGalih->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</a>
                            </div>

                        </td>

                    </tr>

                    @include('admin.petugas.modal.status')
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
