@extends('admin.adminLayouts')

@section('konten')
    <div class="flex flex-col">
        <a class="text-xl font-semibold text-slate-600">Data Users yang sudah daftar</a>
        <button class="bg-blue-400 py-2 px-3 text-white w-fit rounded-lg mt-6" data-modal-target="insert"
            data-modal-toggle="insert">+ Tambah data</button>
        <form class="flex mt-6  justify-between ">
            <select name="status" onchange="this.form.submit()" class="py-2 px-2 rounded-lg" onchange="this.form.submit()"
                id="">
                {{-- <option value="">Pilih nama kategori</option> --}}

                <option value="">Cari status</option>
                <option {{ Request('status') == 'aktif' ? 'selected' : '' }} value="aktif">Aktif</option>
                <option {{ Request('status') == 'ban' ? 'selected' : '' }} value="ban">Ban</option>
                <option {{ Request('status') == 'banned' ? 'selected' : '' }} value="banned">Banned permanent</option>
            </select>
            <div class="flex gap-2">
                <input class="py-1 rounded-lg" placeholder="Cari nama" name="nama" value="{{ Request('nama') }}"
                    type="text">
                <button class="py-2 px-3 bg-blue-400 text-white rounded-lg">Cari</button>
            </div>
        </form>


        @include('admin.peminjamBuku.modal.insertUser')
        <div class="flex text-sm text-red-600 flex-col">
            @foreach ($errors->all() as $galihdata)
                {{ $galihdata }}
            @endforeach
        </div>
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
                            {{ $itemGalih->status }}

                        </td>
                        <td class="px-6 py-4">
                            @if ($itemGalih->status === 'banned')
                                <a class="bg-red-500 text-white py-2 px-3">Akuntelah terbanned</a>
                            @else
                                @if ($itemGalih->status === 'pending')
                                    <a data-modal-target="acc{{ $itemGalih->id_user }}"
                                        data-modal-toggle="acc{{ $itemGalih->id_user }}"
                                        class="cursor-pointer bg-blue-600 text-white py-2 px-4">Acc</a>
                                    <a data-modal-target="tolak{{ $itemGalih->id_user }}"
                                        data-modal-toggle="tolak{{ $itemGalih->id_user }}"
                                        class="cursor-pointer bg-red-600 text-white py-2 px-4">Tolak</a>
                                @else
                                    <a data-modal-target="Ban{{ $itemGalih->id_user }}"
                                        data-modal-toggle="Ban{{ $itemGalih->id_user }}"
                                        class="cursor-pointer bg-red-600 text-white py-2 px-4">{{ $itemGalih->status === 'ban' ? 'unbanned' : 'ban' }}</a>
                                @endif
                            @endif

                            <a href="{{ route('profil.show', $itemGalih->id_user) }}"
                                class="bg-blue-400 text-white py-2 px-3">Detail </a>

                        </td>

                    </tr>

                    @include('admin.peminjamBuku.modal.tolak')
                    @include('admin.peminjamBuku.modal.ban')
                    @include('admin.peminjamBuku.modal.acc')
                @endforeach

            </tbody>
        </table>

    </div>
@endsection
