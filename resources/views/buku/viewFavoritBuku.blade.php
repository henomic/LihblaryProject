 @extends('Layouts.landingPageLayouts')

 @section('konten')
     <div class="min-h-screen w-full flex flex-col items-center">
         <div class="flex gap-3 flex-col container mt-6">
             <h3 class="text-2xl px-5 font-semibold text-slate-600">Buku favorit saya</h3>

             <div class="flex flex-col mt-4">
                 @forelse ($Galihfavorit as $item)
                     <div class="flex h-[10rem] w-full shadow-md p-2 border border-slate-100 relative">
                         <a href="{{ route('PeminjamanBuku.show', $item->buku->bukuId) }}" class="absolute inset-1"></a>
                         <img class="w-[10rem] aspect-square" src="{{ asset('storage/' . $item->buku->foto) }}" alt=""
                             srcset="">

                         <div class="flex gap-2 w-full flex-col">
                             <p class="text-slate-600 font-semibold text-xl">{{ $item->buku->judul }}</p>
                             <p class="text-slate-600 font-semibold text-base">{{ 'penulis : ' . $item->buku->penulis }}
                             </p>
                             <p class="text-slate-600 font-semibold text-base">{{ 'penerbit : ' . $item->buku->penerbit }}
                             </p>

                             <div class="flex justify-between flex-1">
                                 <p class="text-slate-600 font-semibold text-base">
                                     {{ 'tahun penerbit : ' . $item->buku->tahun_terbit }}
                                 </p>

                                 <div class="flex">
                                     <a href="" class="flex   items-center justify-center flex-col">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="#BA8E23" stroke="#BA8E23" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star">
                                             <path
                                                 d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                         </svg>
                                         Favorit</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @empty
                 @endforelse
             </div>
         </div>
     </div>
 @endsection
