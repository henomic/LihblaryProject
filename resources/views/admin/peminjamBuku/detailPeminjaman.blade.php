 @php
     $extend = '';
     if (Auth::user()->level === 'user') {
         # code...
         $extend = 'layouts.landingPageLayouts';
     } else {
         $extend = 'admin.adminLayouts';
     }
 @endphp
 @extends($extend)
 @section('konten')
     <div class="min-h-full">

         <form>
             <button name="print" class="bg-blue-400 px-4 py-2 rounded-lg text-white"><svg xmlns="http://www.w3.org/2000/svg"
                     width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer-check">
                     <path d="M13.5 22H7a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v.5" />
                     <path d="m16 19 2 2 4-4" />
                     <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2" />
                     <path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6" />
                 </svg></button>
         </form>
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
                         @if ($activityLih !== null)
                             <p class="mt-6 max-w-2xl text-sm text-gray-500">
                                 petugas:
                                 {{ $activityLih->causer->nama_lengkap }}
                             </p>
                             <p class="mt-6 max-w-2xl text-sm text-gray-500">
                                 Peminjaman ID:
                                 {{ $DetailPeminjamanGalih->peminjamanId }}
                             </p>
                         @endif
                     </div>


                     <div class="border-t border-gray-200">
                         <dl>
                             <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                 <dt class="text-sm font-medium text-gray-500">Status Peminjaman</dt>
                                 <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                     <span
                                         class="inline-flex items-center rounded-full
                                         {{ $DetailPeminjamanGalih->status === 'dipinjam' ? 'bg-green-200 text-green-800' : '' }}
                                        {{ $DetailPeminjamanGalih->status === 'booking' ? 'bg-green-200 text-green-800' : '' }}
                                         {{ $DetailPeminjamanGalih->status === 'proses' ? 'bg-gray-200 text-gray-800' : '' }}
                                         {{ $DetailPeminjamanGalih->status === 'dihapus' ? 'bg-red-200 text-red-800' : '' }}
                                         {{ $DetailPeminjamanGalih->status === 'tolak' ? 'bg-red-200 text-red-800' : '' }}
                                         {{ $DetailPeminjamanGalih->status === 'dikembaikan' ? 'bg-blue-200 text-blue-800' : '' }}
                                         px-2.5 py-0.5 text-xs font-medium ">
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
                             <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                 <dt class="text-sm font-medium text-gray-500">Foto Buku</dt>
                                 <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                     <img src="{{ asset('storage/' . $DetailPeminjamanGalih->buku->foto) }}"
                                         alt="Foto Buku" class="h-32 w-24 object-cover rounded-md">
                                 </dd>
                             </div>
                             <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                 <dt class="text-sm font-medium text-gray-500">Peminjam</dt>
                                 <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                     <div class="flex items-center">
                                         <div class="h-10 w-10 flex-shrink-0">
                                             <img class="h-10 w-10 rounded-full"
                                                 src="{{ asset('storage/' . $DetailPeminjamanGalih->user->foto) }}"
                                                 alt="Foto Pengguna">
                                         </div>
                                         <div class="ml-4">
                                             <div class="font-medium text-gray-900">
                                                 {{ $DetailPeminjamanGalih->user->nama_lengkap }}</div>
                                             <div class="text-gray-500">{{ $DetailPeminjamanGalih->user->email }}</div>
                                         </div>
                                     </div>
                                 </dd>
                             </div>
                         </dl>
                     </div>
                 </div>
             </div>
         </main>
     </div>
 @endsection
