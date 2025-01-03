 @extends('Layouts.landingPageLayouts')

 @section('konten')
     <section class="relative bg-cover bg-center py-32">
         <div class="absolute inset-1 z-0 bg-black opacity-60"></div>
         <div class="container mx-auto px-6 relative z-10 text-center">
             <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Temukan Duniamu dalam Buku</h1>
             <p class="text-xl text-gray-200 mb-8">Jelajahi ribuan buku dari berbagai genre dan penulis terkenal</p>
         </div>
     </section>

     <section class="py-16 bg-white">
         <div class="container mx-auto px-6">
             <form class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 -mt-32 relative z-20">
                 <h2 class="text-3xl font-semibold text-center mb-6">Cari Buku</h2>
                 <div class="flex flex-col md:flex-row gap-4 mb-6">
                     <div class="flex-grow">
                         <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                         <input value="{{ Request('cari') }}" type="text" id="search" name="cari"
                             placeholder="Cth: Harry Potter, J.K. Rowling"
                             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                     </div>

                     <div class="w-full md:w-64">
                         <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                         <select id="category" name="kategori"
                             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                             <option value="">Semua Kategori</option>
                             @foreach ($kategoriGalih as $kategoriGalihh)
                                 <option {{ Request('kategori') == $kategoriGalihh->kategoriId ? 'selected' : '' }}
                                     value="{{ $kategoriGalihh->kategoriId }}">
                                     {{ $kategoriGalihh->nama_kategori }}
                                 </option>
                             @endforeach
                         </select>
                     </div>
                 </div>

                 <button
                     class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 transition duration-300 text-lg font-semibold">
                     Cari Buku
                 </button>
             </form>
         </div>
     </section>

     <section class="py-16 bg-gray-50">
         <div class="container mx-auto px-6">
             <h2 class="text-3xl font-semibold text-center mb-12">Buku Populer</h2>
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">


                 @foreach ($bukuGalih as $itemGalih)
                     <div
                         class="bg-white buku rounded-lg  relative shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                         <img src="{{ asset('storage/' . $itemGalih->foto) }}" alt="Book Cover"
                             class="w-full h-48 object-cover">
                         <a href="{{ route('PeminjamanBuku.show', $itemGalih->bukuId) }}" class="absolute inset-1"></a>
                         <div class="p-4">
                             <h3 class="judul font-semibold text-lg mb-2">{{ $itemGalih->judul }}</h3>
                             <p class="text-gray-600 mb-2">Penulis: {{ $itemGalih->penulis }}</p>
                             <div class="flex gap-1">
                                 @foreach ($itemGalih->kategori as $kategoriGalih)
                                     <p class="text-sm text-gray-500"> {{ $kategoriGalih->nama_kategori }}</p>
                                 @endforeach
                             </div>
                             <div class="mt-4 flex justify-between items-center">
                                 <span class="text-indigo-600 font-semibold">⭐
                                     {{ number_format($itemGalih->ulasan, 1) }}</span>
                                 <button
                                     class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-sm hover:bg-indigo-200 transition duration-300">
                                     Detail
                                 </button>
                             </div>
                         </div>
                     </div>
                 @endforeach


                 <script>
                     const search = document.getElementById('search');

                     search.addEventListener('input', function() {

                         const cari = this.value;

                         console.log(cari);

                         const judul = document.querySelectorAll('.buku');
                         judul.forEach(element => {
                             const forJudul = element.querySelector('.judul');

                             const judul = forJudul ? forJudul.textContent.toLowerCase() : '';
                             element.style.display = judul.includes(cari) ? '' : 'none';
                         });

                     });
                 </script>
             </div>
         </div>
     </section>
 @endsection
