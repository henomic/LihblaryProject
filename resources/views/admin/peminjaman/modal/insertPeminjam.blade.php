 <!-- Main modal -->
 <div id="crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto  overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

     <div class="bg-black inset-1  absolute bg-opacity-50 top-0 left-0 right-0 bottom-0"></div>
     <div class="relative p-4 w-full  max-w-md max-h-full">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow :bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                 <h3 class="text-xl font-semibold text-gray-900 :text-white">
                     Insert kategori
                 </h3>
                 <button type="button"
                     class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white"
                     data-modal-hide="crud-modal">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>
             <!-- Modal body -->
             <div class="p-4 md:p-5">
                 <form action="{{ route('adminKonfirmasiPeminjaman.store') }}" method="POST" class="space-y-4">
                     @csrf
                     <div class="flex gap-2 flex-col">
                         <label for="user">Pilih user peminjam</label>
                         <select name="id_user" id="user" class="w-full border border-slate-500 rounded-md p-1">
                             <option disabled selected>User peminjam</option>
                             @foreach ($userGalih as $userGalihFor)
                                 <option value="{{ $userGalihFor->id_user }}">{{ $userGalihFor->nama_lengkap }}</option>
                             @endforeach
                         </select>


                     </div>
                     <div class="flex gap-2 flex-col mt-8">
                         <label for="">Pilih buku</label>
                         <select name="id_buku[]" multiple id="buku"
                             class="w-full  border border-slate-500 rounded-md p-1">
                             @foreach ($bukuGalih as $bukuGalihFor)
                                 <option value="{{ $bukuGalihFor->bukuId }}">{{ $bukuGalihFor->judul }}</option>
                             @endforeach
                         </select>
                     </div>



                     <script>
                         document.addEventListener("DOMContentLoaded", () => {
                             new TomSelect("#buku", {
                                 plugins: ['remove_button'],
                                 create: false,
                                 maxItems: 3
                             });
                         });
                     </script>
                     <button type="submit"
                         class="w-full mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Buat
                         data</button>

                 </form>
             </div>
         </div>
     </div>
 </div>
