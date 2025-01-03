@extends('admin.adminLayouts')

@section('konten')
    <button data-modal-target="konfirmasi" data-modal-toggle="konfirmasi"
        class="block w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        + pencatatan
    </button>
    @include('admin.buku.modal.modalPemilihan')

    @include('admin.buku.modal.tambahStokpencatatan')
    @if ($bukuGalih->stok > 0)
        @include('admin.buku.modal.stokKurangPencatatan')
    @endif

    <div class="relative overflow-x-auto shadow-md w-full p-5 mt-4 sm:rounded-lg">


        <div class="flex flex-col  text-base text-left  font-semibold  text-gray-600 bg-white :text-white :bg-gray-800">
            Buku {{ $bukuGalih->judul }}
            <p class=" text-sm font-normal text-gray-500 :text-gray-400">
                Detail pencatatan stok dari buku {{ $bukuGalih->judul }}

            </p>

            <a class="text-slate-600 text-lg font-semibold mt-6">Total stok di buku ini {{ $bukuGalih->stok }} Buku dan total
                Buku Yang di pinjam adalah {{ $GalihTotalPeminjam }}</a>
            <div class="flex text-sm text-red-600 flex-col">
                @foreach ($errors->all() as $galihdata)
                    {{ $galihdata }}
                @endforeach
            </div>


        </div>
        <div class="w-full mt-6">
            {{-- {{ $bukuGalih->bukuId }} --}}
            <form class="flex justify-between" action="{{ route('adminBuku.show', $bukuGalih->bukuId) }}">
                @csrf
                @method('put')
                <button name="print" value="" type="submit"
                    class="bg-blue-400 text-white py-2 px-4 rounded-lg">Print</button>


                <div class="flex gap-3">

                    <form class="flex mt-6  justify-between ">
                        <div class="flex gap-2">
                            <input value="{{ Request('date1') }}" onchange="this.form.submit()" name="date1"
                                class="rounded-lg" type="date">
                            <input value="{{ Request('date2') }}" onchange="this.form.submit()" name="date2"
                                class="rounded-lg" type="date">
                        </div>

                    </form>

                    <select onchange="this.form.submit()" name="urutan_stok" class="rounded-lg" id="">
                        <option value="">Pemilihan stok</option>
                        <option {{ Request('urutan_stok') == 'desc' ? 'selected' : '' }} value="desc">Stok tertinggi
                        </option>
                        <option {{ Request('urutan_stok') == 'asc' ? 'selected' : '' }} value="asc">Stok terendah
                        </option>
                    </select>
                    <select onchange="this.form.submit()" name="status" class="rounded-lg" id="">
                        <option value="">Status</option>
                        <option {{ Request('status') === 'pengurangan' ? 'selected' : '' }} value="pengurangan">pengurangan
                        </option>
                        <option {{ Request('status') === 'penambahan' ? 'selected' : '' }} value="penambahan">penambahan
                        </option>
                    </select>
                </div>
            </form>
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

    <script>
        const maxVal = @json($bukuGalih->stok);
        const penambahan = document.getElementById('stokPengurangan').addEventListener('keyup', function() {
            if (this.value >= maxVal) {
                this.value = maxVal;
            }
        });
        document.querySelectorAll('.stok').forEach(element => {
            element.addEventListener('keyup', function() {
                const value = this.value;
                console.log(value);

                if (value < 0) {
                    this.value = 0;
                }



            });
        });
    </script>
@endsection
