 <!-- Main modal -->
 <div id="tambah" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

     <div class="bg-black inset-1 absolute bg-opacity-50 top-0 left-0 right-0 bottom-0"></div>
     <div class="relative p-4 w-full flex justify-center  max-h-full">
         <!-- Modal content -->
         <div class="relative bg-white w-[40rem] rounded-lg shadow :bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                 <h3 class="text-xl font-semibold text-gray-900 :text-white">
                     Tambah stok
                 </h3>
                 <button type="button"
                     class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white"
                     data-modal-hide="tambah">
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
                 <form action="{{ route('stok.update', $bukuGalih->bukuId) }}" enctype="multipart/form-data"
                     method="POST" class="space-y-4">
                     @csrf
                     @method('put')

                     <div>
                         <label for="email"
                             class="block mb-2 text-sm font-medium text-gray-900 :text-white">Keterangan</label>
                         <input type="text" name="keterangan" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>
                     <div>
                         <label for="email" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Stok
                             buku</label>
                         <input type="number" name="stok" id=""
                             class="bg-gray-50 stok border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>




                     <button name="status" value="penambahan" type="submit"
                         class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Buat
                         data</button>

                 </form>


             </div>
         </div>
     </div>
 </div>
