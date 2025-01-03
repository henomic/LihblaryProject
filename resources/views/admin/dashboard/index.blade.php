 @extends('admin.adminLayouts')

 @section('konten')
     <main class="flex-1 p-8 overflow-y-auto">

         <h2 class="text-3xl font-bold mb-6 text-indigo-800">Dashboard Overview</h2>

         <!-- Quick Stats -->
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
             <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-indigo-500">
                 <h3 class="text-xl font-semibold mb-2 text-indigo-800">Total semua buku</h3>
                 <p class="text-3xl font-bold">{{ $totalBukuGalih }}</p>
             </div>
             <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                 <h3 class="text-xl font-semibold mb-2 text-green-700">Akumulasi semua judul buku</h3>
                 <p class="text-3xl font-bold">{{ $totalJudulGalih }}</p>
             </div>
             <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                 <h3 class="text-xl font-semibold mb-2 text-yellow-700">Total semua user</h3>
                 <p class="text-3xl font-bold">{{ $totalUserGalih }}</p>
             </div>
             {{-- <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
                 <h3 class="text-xl font-semibold mb-2 text-red-700">Overdue Books</h3>
                 <p class="text-3xl font-bold">89</p>
             </div> --}}
         </div>

         <!-- Top Books Section -->
         <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
             <!-- Most Borrowed Books -->
             <div class="bg-white p-6 rounded-lg shadow-md">
                 <h3 class="text-xl font-semibold mb-4 text-indigo-800">Most Borrowed Books</h3>
                 <ul class="space-y-2">
                     @foreach ($bukuPinjamTerbanyakGalih as $peminjamterbanyakgalih)
                         <li class="flex items-center justify-between">
                             <span class="font-medium">{{ $peminjamterbanyakgalih->buku->judul }}</span>
                             <span
                                 class="bg-indigo-100 text-indigo-800 py-1 px-2 rounded-full text-sm">{{ $peminjamterbanyakgalih->total_peminjaman }}</span>
                         </li>
                     @endforeach

                 </ul>
             </div>

             <!-- Highest Rated Books -->
             <div class="bg-white p-6 rounded-lg shadow-md">
                 <h3 class="text-xl font-semibold mb-4 text-indigo-800">Buku dengan jumlah rating tertinggi</h3>
                 <ul class="space-y-2">

                     @foreach ($RatingTertinggiGalih as $ratingGedeGalih)
                         <li class="flex items-center justify-between">
                             <span class="font-medium">{{ $ratingGedeGalih->buku->judul }}</span>
                             <div class="flex items-center">
                                 <span class="text-yellow-400 mr-1"><i class="fas fa-star"></i></span>
                                 <span>{{ number_format($ratingGedeGalih->ratings, 1) }}/5</span>
                             </div>
                         </li>
                     @endforeach

                 </ul>
             </div>
         </div>

         <!-- Recent Loans Table -->
         <div class="bg-white p-6 rounded-lg shadow-md mb-8">
             <h3 class="text-xl font-semibold mb-4 text-indigo-800">Peminjaman buku</h3>
             <div class="overflow-x-auto">
                 <table class="w-full text-left">
                     <thead>
                         <tr class="bg-indigo-100">
                             <th class="p-3">User</th>
                             <th class="p-3">Buku</th>
                             <th class="p-3">Waktu peminjaman</th>
                             <th class="p-3">Waktu pengembalian</th>
                             <th class="p-3">Status</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($statusPeminjaman as $itemGalih)
                             <tr class="border-b">
                                 <td class="p-3">{{ $itemGalih->user->nama_lengkap }}</td>
                                 <td class="p-3">{{ $itemGalih->buku->judul }}</td>
                                 <td class="p-3">
                                     {{ \Carbon\Carbon::parse($itemGalih->tanggalPeminjaman)->format('d F Y') }}</td>
                                 <td class="p-3">
                                     {{ \Carbon\Carbon::parse($itemGalih->tanggalPengembalian)->format('d F Y') }}
                                 </td>

                                 <td class="p-3"><span
                                         class="bg-green-200 text-green-800 py-1 px-2 rounded-full text-sm">
                                         {{ $itemGalih->status }}

                                     </span>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>

         {{-- <div class="bg-white p-6 rounded-lg shadow-md">
             <h3 class="text-xl font-semibold mb-4 text-indigo-800">User Activity</h3>
             <div class="overflow-x-auto">
                 <table class="w-full text-left">
                     <thead>
                         <tr class="bg-indigo-100">
                             <th class="p-3">User</th>
                             <th class="p-3">Email</th>
                             <th class="p-3">Total Loans</th>
                             <th class="p-3">Current Loans</th>
                             <th class="p-3">Last Activity</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr class="border-b">
                             <td class="p-3">John Doe</td>
                             <td class="p-3">john@example.com</td>
                             <td class="p-3">27</td>
                             <td class="p-3">2</td>
                             <td class="p-3">2023-05-15 (Borrowed)</td>
                         </tr>
                         <tr class="border-b">
                             <td class="p-3">Jane Smith</td>
                             <td class="p-3">jane@example.com</td>
                             <td class="p-3">42</td>
                             <td class="p-3">1</td>
                             <td class="p-3">2023-05-14 (Borrowed)</td>
                         </tr>
                         <tr class="border-b">
                             <td class="p-3">Bob Johnson</td>
                             <td class="p-3">bob@example.com</td>
                             <td class="p-3">15</td>
                             <td class="p-3">1</td>
                             <td class="p-3">2023-05-10 (Borrowed)</td>
                         </tr>
                         <tr class="border-b">
                             <td class="p-3">Alice Brown</td>
                             <td class="p-3">alice@example.com</td>
                             <td class="p-3">31</td>
                             <td class="p-3">1</td>
                             <td class="p-3">2023-05-16 (Borrowed)</td>
                         </tr>
                         <tr>
                             <td class="p-3">Charlie Wilson</td>
                             <td class="p-3">charlie@example.com</td>
                             <td class="p-3">19</td>
                             <td class="p-3">1</td>
                             <td class="p-3">2023-05-13 (Borrowed)</td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div> --}}



     </main>
     =
 @endsection
