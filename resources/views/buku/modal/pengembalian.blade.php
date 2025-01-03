  <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full  items-center justify-center"
      id="peminjaman">
      <div class="relative p-8 bg-white w-full max-w-[60rem] m-auto flex-col flex rounded-lg shadow-lg">
          <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-gray-800">Formulir peminjaman buku</h2>
              <button class="modalBut text-gray-600  hover:text-gray-800">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                      </path>
                  </svg>
              </button>
          </div>

          <div class="flex flex-col md:flex-row md:space-x-8">
              <div class="w-full md:w-1/2 flex flex-col items-center mb-6 md:mb-0">
                  <img src="{{ asset('storage/' . $bukuGalih->foto) }}" alt="Book Cover"
                      class="w-80 aspect-square object-cover rounded-lg shadow-md mb-4">
                  <h3 class="text-xl font-semibold text-gray-800 text-center">{{ $bukuGalih->judul }}</h3>
                  <p class="text-sm text-gray-600 mt-1">{{ $bukuGalih->penulis }}</p>
              </div>

              <div class="w-full md:w-1/2">
                  <form method="POST" action="{{ route('PeminjamanBuku.store') }}"
                      class="flex flex-col h-full justify-between">
                      @csrf
                      <div>

                          <label for="borrowDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                              peminjaman</label>

                          <input id="date" type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                              id="borrowDate" name="minjam" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                      </div>
                      <div>
                          <a class="block text-lg font-medium text-red-600 mt-6 mb-1">batas tanggal
                              pengembalian maksimal adalah 7 hari</a>


                          <button name="id" value="{{ $bukuGalih->bukuId }}" type="submit"
                              class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                              Borrow Book
                          </button>
                      </div>
                  </form>
              </div>
          </div>
          {{-- <script>
                  document.getElementById('date').addEventListener('change', function() {
                      var pengembalian = new Date(this.value);
                      pengembalian.setDate(pengembalian.getDate() + 7);
                      console.log(pengembalian);
                      document.getElementById('result').value = pengembalian.toLocaleDateString('id-ID');
                  });
              </script> --}}

          <div class="mt-6 text-center">
              <p class="text-sm text-gray-600">By borrowing this book, you agree to our <a href="#"
                      class="text-blue-600 hover:underline">terms and conditions</a>.</p>
          </div>
      </div>
  </div>
