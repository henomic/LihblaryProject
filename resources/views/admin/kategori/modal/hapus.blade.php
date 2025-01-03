 <!-- Main modal -->
 <div id="hapus{{ $itemGalih->kategoriId }}" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

     <div class="bg-black inset-1 absolute bg-opacity-50 top-0 left-0 right-0 bottom-0"></div>
     <div class="relative p-4 w-full max-w-md max-h-full">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow :bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                 <h3 class="text-xl font-semibold text-red-500 :text-white">
                     Apakah anda yakin akan menghapus data {{ $itemGalih->nama_kategori }}?
                 </h3>
                 <button type="button"
                     class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white"
                     data-modal-hide="hapus{{ $itemGalih->kategoriId }}">
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
                 <form action="{{ route('adminKategori.destroy', $itemGalih->kategoriId) }}" method="POST"
                     class="space-y-4">
                     @csrf
                     @method('delete')

                     <button type="submit"
                         class="w-full text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Hapus
                         data</button>

                 </form>
             </div>
         </div>
     </div>
 </div>