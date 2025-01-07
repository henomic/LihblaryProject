@extends('admin.adminLayouts')

@section('konten')
    <div class="flex mb-16 justify-between w-full">

        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Insert
        </button>



    </div>

    @include('admin.kategori.modal.insert')

    <style>
        .dataTables_length select {
            padding: 0.5rem;
            background-color: #f9fafb;
            /* Latar belakang sesuai Tailwind */
            border: 1px solid #ddd;
            /* Border sesuai Tailwind */
            border-radius: 0.375rem;
            /* Radius sesuai Tailwind */
            color: #4b5563;
            /* Teks berwarna sesuai Tailwind */
            font-size: 0.875rem;
        }
    </style>



    <table id="dataTable" class="w-full mt-44">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama kategori
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah buku
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal pembuatan
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>

            </tr>
        </thead>

        <tbody></tbody>


        {{-- <tbody>
                @foreach ($Galih_kategori as $itemGalih)
                    <tr class="bg-white border-b :bg-gray-800 :border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap :text-white">
                            {{ $itemGalih->nama_kategori }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $itemGalih->bukuCount }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $itemGalih->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 ">
                            <a data-modal-target="edit{{ $itemGalih->kategoriId }}"
                                data-modal-toggle="edit{{ $itemGalih->kategoriId }}"
                                class="font-medium text-blue-600 cursor-pointer :text-blue-500 hover:underline">Edit</a>
                            @if ($itemGalih->bukuCount <= 0)
                                <a data-modal-target="hapus{{ $itemGalih->kategoriId }}"
                                    data-modal-toggle="hapus{{ $itemGalih->kategoriId }}"
                                    class="font-medium
                                    cursor-pointer text-red-600 :text-blue-500 hover:underline">Delete</a>
                            @endif
                        </td>
                    </tr>

                    @include('admin.kategori.modal.hapus')
                @endforeach

            </tbody> --}}


    </table>
    @include('admin.kategori.modal.editModal')


    <script>
        $(document).ready(function() {




            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('adminKategori.index') }}',
                columns: [{
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'bukuCount',
                        name: 'bukuCount'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            const date = new Date(data);
                            const option = {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            };
                            return date.toLocaleDateString('id-ID', option);
                        }
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
                },
                createdRow: function(row, data, dataIndex) {
                    $('td', row).each(function(index) {
                        $(this).addClass('px-6 py-4');
                    });

                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                pageLength: 10,

            });


            // $('$formKategoriEdit').on('submit', function(e) {
            //     e.preventDefault();
            //     $.(ajax)({
            //         url: "{{ route('adminKategori.update', '') }}/"
            //     });
            // });



            $('#dataTable').on('click', '.edit-btn', function() {

                var data = table.row($(this).closest('tr')).data();
                $('#kategori').val(data.nama_kategori);
                $('#idKategori').val(data.kategoriId);
                // console.log($('#idKategori').val());

                $('#edit').removeClass('hidden').addClass('flex');
            });

            $('#formKategoriEdit').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('adminKategori.update', '') }}/" + $('#idKategori').val(),
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Tutup modal
                            $('#edit').removeClass('flex').addClass('hidden');

                            // Refresh DataTable
                            $('#dataTable').DataTable().ajax.reload();

                            // Tampilkan pesan sukses (gunakan library notifikasi yang Anda pakai)
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat memperbarui data');
                    }
                });
            });


            $('[data-modal-hide="edit"]').on('click', function() {
                $('#edit').removeClass('flex').addClass('hidden');

            });
        });
    </script>
@endsection
