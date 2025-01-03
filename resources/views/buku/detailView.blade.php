  @extends('Layouts.landingPageLayouts')

  @section('konten')

      @if (Auth::check() and Auth::user()->status === 'pending')
          <div class="p-4 mb-4   w-full text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
              role="alert">
              <div class="flex items-center">
                  <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor" viewBox="0 0 20 20">
                      <path
                          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                  </svg>
                  <span class="sr-only">Info</span>
                  <h3 class="text-lg font-medium">Pemberitahuan !</h3>
              </div>
              <div class="mt-2 mb-4 text-sm">
                  Akun anda masih belum di setujui oleh admin untuk bisa meminjam buku di perpustakaan ini, Mohon sabar
                  sejenak
                  karna admin sedang memeriksa akun anda
              </div>
              {{-- <div class="flex">
                <button type="button"
                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800">
                <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 14">
                    <path
                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                </svg>
                View more
            </button>
            <button type="button"
            class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-yellow-300 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-gray-800 dark:focus:ring-yellow-800"
            data-dismiss-target="#alert-additional-content-4" aria-label="Close">
            Dismiss
        </button>
    </div> --}}
          </div>
      @endif

      <div class="px-4 py-6 sm:px-0">
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6">
                  <h2 class="text-2xl font-semibold text-gray-900">{{ $bukuGalih->judul }}</h2>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">Oleh: {{ $bukuGalih->penulis }}</p>
              </div>
              <div class="border-t border-gray-200">
                  <dl>
                      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                          <dt class="text-sm font-medium text-gray-500">Sampul Buku</dt>
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              <img src="{{ asset('/storage/' . $bukuGalih->foto) }}" alt="Sampul Buku"
                                  class="w-48 h-auto object-cover rounded">
                          </dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                          <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $bukuGalih->penerbit }}</dd>
                      </div>
                      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                          <dt class="text-sm font-medium text-gray-500">Tahun Terbit</dt>
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $bukuGalih->tahun_terbit }}</dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                          <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              @foreach ($bukuGalih->kategori as $item)
                                  {{ $item->nama_kategori }}
                              @endforeach
                          </dd>
                      </div>
                      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                          <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              {{ $bukuGalih->sinopsis }}
                          </dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                          <dt class="text-sm font-medium text-gray-500">Status</dt>
                          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              @if ($bukuGalih->stok >= 5)
                                  <span
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                      Tersedia
                                  </span>
                              @elseif ($bukuGalih->stok < 5)
                                  <span
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                      Hampir habis
                                  </span>
                              @endif
                          </dd>
                      </div>
                  </dl>
              </div>
              <div class="px-4 py-3 flex gap-2 mt-6 justify-end bg-gray-50 text-right sm:px-6">

                  @if (Auth::check())
                      @if ($cekJumlahPeminjamanBukuGalih < 3 and Auth::user()->status === 'aktif')
                          <button data-modal-target="peminjaman" data-modal-toggle="peminjaman"
                              class="inline-flex {{ $GalihCekPembelian >= 1 ? 'bg-slate-600 hover:bg-slate-700' : 'modalBut bg-indigo-600 hover:bg-indigo-700' }} justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              {{ $GalihCekPembelian >= 1 ? 'Buku sudah di pinjam' : 'Pinjam Buku' }}

                          </button>
                      @else
                          <a
                              class="inline-flex  justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              {{ Auth::user()->status === 'pending' ? 'Maaf akun anda belum terverifikasi oleh admin' : 'Anda tidak dapat meminjam buku lebih dari 3 kali' }}
                          </a>
                      @endif
                  @else
                      <form action="{{ route('PeminjamanBuku.store') }}" method="post">
                          @csrf

                          <button
                              class="inline-flex  justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              Pinjam Buku
                          </button>

                      </form>
                  @endif
                  @include('buku.modal.pengembalian')

                  <script>
                      document.querySelectorAll('.modalBut').forEach(element => {
                          element.addEventListener('click', function() {
                              modal = document.getElementById('peminjaman');

                              if (modal.classList.contains('flex')) {
                                  modal.classList.add('hidden');
                                  modal.classList.remove('flex');
                              } else {
                                  modal.classList.add('flex');
                                  modal.classList.remove('hidden');

                              }
                          })
                      });
                  </script>



                  <form action="{{ route('favorit') }}" method="POST">
                      @method('get')
                      <button name="id_buku" value="{{ $bukuGalih->bukuId }}" type="submit"
                          class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white {{ $cekGalih ? 'bg-indigo-600' : 'bg-slate-400' }}  hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round" class="lucide lucide-book-heart">
                                  <path
                                      d="M16 8.2A2.22 2.22 0 0 0 13.8 6c-.8 0-1.4.3-1.8.9-.4-.6-1-.9-1.8-.9A2.22 2.22 0 0 0 8 8.2c0 .6.3 1.2.7 1.6A226.652 226.652 0 0 0 12 13a404 404 0 0 0 3.3-3.1 2.413 2.413 0 0 0 .7-1.7" />
                                  <path
                                      d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
                              </svg></i>

                          Favorit
                      </button>
                  </form>
              </div>
          </div>

          <div class="bg-white rounded-lg shadow-md p-6">
              <h2 class="text-2xl font-bold mb-4">Product Reviews</h2>
              <div class="flex gap-4 items-center mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="#D5AB55"
                      stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-star">
                      <path
                          d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                  </svg>
                  <span class="text-gray-600 text-xl">{{ number_format($ratingGalih, 1) }} out of 5</span>
              </div>
              @if (Auth::check() and $GalihCekPeminjaman > 0)
                  @include('buku.modal.komen')
                  @if ($ulasanSaya)
                      <div class="flex mt-4 flex-col bg-slate-50 rounded-lg w-full p-4">
                          <div class="flex gap-4 items-center">
                              <h1 class="text-lg font-semibold  ">
                                  Ulasan saya
                              </h1>

                              <a class="komenBut cursor-pointer text-sm text-blue-500">Edit komentar</a>


                          </div>
                          <div class="flex mt-2 items-center">
                              <img src="{{ asset('storage/' . $ulasanSaya->user->foto) }}"
                                  class="w-8 rounded-full overflow-hidden aspect-square " alt="" srcset="">
                              <a class="text-slate-600 ml-1">{{ $ulasanSaya->user->username }}

                              </a>

                              <a class="ml-3 text-sm text-slate-700">{{ \Carbon\Carbon::parse($ulasanSaya->created_at)->format('d F Y') }}
                                  {{ $ulasanSaya->created_at != $ulasanSaya->updated_at ? '(Update)' : '' }}</a>
                          </div>
                          <div class="flex gap-1 mt-4">
                              @for ($i = 0; $i < $ulasanSaya->rating; $i++)
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                      fill="#D5AB55" stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round"
                                      stroke-linejoin="round" class="lucide lucide-star">
                                      <path
                                          d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                  </svg>
                              @endfor
                          </div>


                          <div class="bg-slate-100 rounded-lg mt-2 p-3 ">
                              <a class="text ">
                                  {{ $ulasanSaya->ulasan }}
                              </a>
                          </div>
                      </div>
                  @else
                      <a class="komenBut bg-blue-500 py-2 px-3 rounded-lg text-white mt-6 cursor-pointer">Tambah
                          komentar</a>
                  @endif
              @endif

              <div class="border-t pt-6">



                  <h3 class="font-bold text-lg mb-4 mt-6">Customer Reviews</h3>


                  @foreach ($ulasanBukuIniGalih as $ulasanGalihBuku)
                      <div class="mb-6 mt-6">
                          <div class="flex justify-between w-full">
                              <div class="flex items-center mb-2">
                                  <img class="h-8 w-8 rounded-full mr-2"
                                      src="{{ asset('storage/' . $ulasanGalihBuku->user->foto) }}" alt="User Avatar">
                                  <span class="font-semibold">{{ $ulasanGalihBuku->user->username }}</span>
                              </div>


                              <a>{{ \Carbon\Carbon::parse($ulasanGalihBuku->created_at)->format('d F Y') }}
                                  {{ $ulasanGalihBuku->created_at != $ulasanGalihBuku->updated_at ? '(Update)' : '' }}
                              </a>
                          </div>
                          <div class="flex gap-1 items-center mb-2">
                              @for ($i = 0; $i < $ulasanGalihBuku->rating; $i++)
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                      viewBox="0 0 24 24" fill="#D5AB55" stroke="#D5AB55" stroke-width="1.25"
                                      stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star">
                                      <path
                                          d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                  </svg>
                              @endfor
                          </div>
                          <p class=" text-gray-600">{{ $ulasanGalihBuku->ulasan }}
                          </p>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>

      <script>
          document.addEventListener('DOMContentLoaded', function() {

              document.querySelectorAll('.komenBut').forEach(element => {
                  element.addEventListener('click', function() {
                      console.log('ww');
                      modalKomen = document.getElementById('komenModal');
                      if (modalKomen.classList.contains('hidden')) {
                          modalKomen.classList.remove('hidden');
                          modalKomen.classList.add('flex');

                      } else {
                          modalKomen.classList.remove('flex');
                          modalKomen.classList.add('hidden');
                      }

                  });
              });
          });
      </script>

      <script>
          let starEdit = 0;

          starEdit = @json($ulasanGalih->rating ?? 0);
          star = document.querySelectorAll('.star');
          inputStar = document.getElementById('star');


          //   console.log(starEdit);

          console.log(starEdit);


          function funcStar() {

              star.forEach(element => {
                  valueStarNow = element.getAttribute('data-value');

                  if (valueStarNow <= starEdit) {
                      element.setAttribute('fill', '#D5AB55');
                  } else {
                      element.setAttribute('fill', '#ccc');
                  }
              });

          };


          funcStar();



          star.forEach((element) => {
              element.addEventListener('mouseenter', function() {

                  console.log(this.getAttribute('data-value'));


                  value = this.getAttribute('data-value');

                  //   value = value.replace(starEdit);

                  inputStar.value = value;

                  star.forEach(d => {
                      if (d.getAttribute('data-value') <= value) {
                          d.setAttribute('fill', '#D5AB55');

                      } else {
                          d.setAttribute('fill', '#ccc');

                      }
                  });

              });
              element.addEventListener('mouseleave', function() {

                  console.log(this.getAttribute('data-value'));
                  inputStar = document.getElementById('star');
                  value = this.getAttribute('data-value');

                  inputStar.value = value;



              });

          });
      </script>


  @endsection
