  @extends('admin.adminLayouts')

  @section('konten')
      <div class="flex flex-col">

          <h3 class="text-slate-500 font-semibold text-2xl">
              Rekam aktivitas pengguna
          </h3>
          <form class="flex mt-6  justify-between ">
              <div class="flex gap-2">
                  <input value="{{ Request('date1') }}" onchange="this.form.submit()" name="date1" class="rounded-lg"
                      type="date">
                  <input value="{{ Request('date2') }}" onchange="this.form.submit()" name="date2" class="rounded-lg"
                      type="date">
              </div>
              <div class="flex gap-2">
                  <input class="py-1 rounded-lg" placeholder="Cari nama" name="nama" value="{{ Request('nama') }}"
                      type="text">
                  <button class="py-2 px-3 bg-blue-400 text-white rounded-lg">Cari</button>
              </div>
          </form>
          <table class="w-full noscrollbar text-sm text-left rtl:text-right text-gray-500 mt-6 :text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                  <tr>


                      <th scope="col" class="px-6 py-3">
                          Nama petugas/Admin
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Melakukan aktifitas di table
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Deskripsi
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Detail aktifitas
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Waktu
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($aktivitasGalih as $itemGalih)
                      @php

                          $oldGalih = $itemGalih->properties['old'] ?? [''];
                          $atributGalih = $itemGalih->properties['attributes'] ?? [''];
                      @endphp
                      <tr class="bg-white  border-b :bg-gray-800 :border-gray-700  :hover:bg-gray-600">


                          <th scope="row"
                              class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap :text-white">
                              <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $itemGalih->causer->foto) }}"
                                  alt="Jese image">
                              <div class="ps-3">
                                  {{ $itemGalih->causer->nama_lengkap ?? '' }}
                              </div>
                          </th>
                          <td class="px-6 py-4">
                              {{ $itemGalih->properties['new_data']['model'] }}

                          </td>
                          <td class="px-6 py-4">
                              {{ $itemGalih->description ?? '' }}
                          </td>
                          <td class="px-6 py-4">

                              @if ($itemGalih->properties['new_data']['model'] === 'peminjaman')
                                  <div class="flex flex-col">
                                      @if ($itemGalih->properties['old_data'] ?? '')
                                          <a>Data sebelum nya {{ $itemGalih->properties['old_data']['status'] ?? '' }}</a>
                                      @endif

                                      <a>data baru {{ $itemGalih->properties['new_data']['status'] ?? '' }}
                                      </a>
                                      <div class="flex  flex-col">
                                          <span>ID
                                              {{ $itemGalih->properties['new_data']['model'] ?? null }}
                                              {{ $itemGalih->properties['new_data']['id_peminjaman'] ?? null }}
                                          </span>
                                          @if ($itemGalih->properties['new_data']['model'] === 'peminjaman')
                                              <a class="bg-blue-400 rounded-lg text-white w-fit py-2 px-3 mt-2"
                                                  href="{{ route('detailPeminjaman', $itemGalih->properties['new_data']['id_peminjaman']) }}">Lihat
                                                  detail</a>
                                          @endif
                                      </div>
                                  </div>
                              @endif



                              @if ($itemGalih->properties['new_data']['model'] === 'kategori')
                                  <div class="flex  flex-col">
                                      @if ($itemGalih->properties['old_data'] ?? '')
                                          <span>
                                              <a class="">Data
                                                  {{ $itemGalih->properties['old_data']['status'] ?? null }}</a>

                                              {{ $itemGalih->properties['old_data']['nama_kategori'] ?? '' }}
                                          </span>
                                      @endif
                                      <span class="{{ $itemGalih->event === 'delete' ? 'hidden' : '' }}">
                                          {{ $itemGalih->properties['old_data'] ?? '' ? 'menjadi' : 'membuat' }}
                                          {{ $itemGalih->properties['new_data']['nama_kategori'] ?? null }}
                                          {{ $itemGalih->properties['new_data']['id_peminjaman'] ?? null }}
                                      </span>
                                  </div>
                              @endif
                              @if ($itemGalih->properties['new_data']['model'] === 'buku')
                                  <div class="flex  flex-col">

                                      <span class="{{ $itemGalih->event === 'delete' ? 'hidden' : '' }}">
                                          @if ($itemGalih->event === 'menambah')
                                              {{ $itemGalih->properties['old_data'] ?? '' ? 'menjadi Buku ' : 'membuat buku ' }}
                                          @elseif($itemGalih->event === 'hapus')
                                              menghapus buku
                                          @else
                                          @endif
                                          {{ $itemGalih->properties['new_data']['judul'] ?? null }}
                                          {{ $itemGalih->properties['new_data']['id_peminjaman'] ?? null }}
                                      </span>
                                  </div>
                              @endif
                              @if ($itemGalih->properties['new_data']['model'] === 'pencatatan Stok')
                                  <div class="flex  flex-col">

                                      <span>
                                          {{ $itemGalih->properties['new_data']['catatan'] }}
                                      </span>

                                      <a class="bg-blue-400 py-2 px-3 w-fit text-white rounded-lg"
                                          href="{{ route('adminBuku.show', $itemGalih->properties['new_data']['bukuId']) }}">Lihat
                                          detail</a>
                                  </div>
                              @endif
                              @if ($itemGalih->properties['new_data']['model'] === 'User')
                                  <div class="flex  flex-col">

                                      @if ($itemGalih->properties['new_data']['aksi'] ?? '')
                                          @if ($itemGalih->properties['new_data']['aksi'] === 'nambah')
                                              <span>
                                                  Menambah data user
                                              </span>
                                          @endif
                                          @if ($itemGalih->properties['new_data']['aksi'] === 'validasi')
                                              <span>
                                                  Mengubah data user menjadi
                                                  {{ $itemGalih->properties['new_data']['data'] }}
                                              </span>
                                          @endif
                                      @else
                                          <span>
                                              Login ke aplikasi
                                              {{-- {{ $itemGalih->properties['new_data']['catatan'] }} --}}
                                          </span>
                                      @endif


                                  </div>
                              @endif

                          </td>

                          <td class="px-6 py-4">
                              {{ \Carbon\Carbon::parse($itemGalih->created_at)->format('d F Y') }}
                          </td>

                      </tr>
                  @endforeach




              </tbody>
          </table>
          {{ $aktivitasGalih->links() }}

      </div>
  @endsection
