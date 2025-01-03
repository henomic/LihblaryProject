 <!-- Main modal -->
 <div id="insert" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

     <div class="bg-black inset-1 absolute bg-opacity-50 top-0 left-0 right-0 bottom-0"></div>
     <div class="relative p-4 w-full flex justify-center  max-h-full">
         <!-- Modal content -->
         <div class="relative bg-white w-[40rem] rounded-lg shadow :bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                 <h3 class="text-xl font-semibold text-gray-900 :text-white">
                     Tambah petugas/Admin
                 </h3>
                 <button type="button"
                     class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white"
                     data-modal-hide="insert">
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
                 <form action="{{ route('peminjamBukuConrtol.store') }}" enctype="multipart/form-data" method="POST"
                     class="space-y-4">
                     @csrf
                     <div>
                         <label for="email"
                             class="block mb-2 text-sm font-medium text-gray-900 :text-white">Nama</label>
                         <input type="text" name="nama" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>
                     <div>
                         <label for="email"
                             class="block mb-2 text-sm font-medium text-gray-900 :text-white">Username</label>
                         <input type="text" name="username" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>
                     <div>
                         <label for="email"
                             class="block mb-2 text-sm font-medium text-gray-900 :text-white">email</label>
                         <input type="email" name="email" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>
                     <div class="flex gap-2 w-full">
                         <div class="flex flex-col flex-1">
                             <label for="email"
                                 class="block mb-2 text-sm font-medium text-gray-900 :text-white">Nik</label>
                             <input type="text" name="nik" id="email"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                                 required />
                         </div>


                     </div>

                     <div>
                         <label for="email"
                             class="block mb-2 text-sm font-medium text-gray-900 :text-white">Alamat</label>
                         <input type="text" name="alamat" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>
                     <div>
                         <label for="email" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Foto
                             profil</label>
                         <input type="file" name="foto" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white"
                             required />
                     </div>




                     {{-- <input type="file"> --}}


                     <button type="submit"
                         class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Buat
                         data</button>

                 </form>

                 <script>
                     document.querySelectorAll('.stok').forEach(element => {
                         element.addEventListener('keyup', function() {
                             const val = this.value;

                             if (val < 0) {
                                 this.value = 1;
                             }
                         })
                     });
                 </script>
             </div>
         </div>
     </div>
 </div>
