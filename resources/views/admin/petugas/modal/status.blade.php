<!-- Main modal -->
<div id="status{{ $itemGalih->id_user }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="bg-black inset-1 absolute bg-opacity-50 top-0 left-0 right-0 bottom-0"></div>
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow :bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                <h3 class="text-xl font-semibold  :text-white">
                    Apakah anda yakin akan memberi status {{ $itemGalih->status === 'aktif' ? 'Nonaktif' : 'Aktif' }}
                    pada
                    pengguna ini?

                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white"
                    data-modal-hide="status{{ $itemGalih->id_user }}">


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
                <form action="{{ route('adminPetugas.update', $itemGalih->id_user) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('put')

                    {{ $itemGalih->status }}
                    <button name="status" value="{{ $itemGalih->status === 'aktif' ? 'nonaktif' : 'aktif' }}"
                        class="{{ $itemGalih->status === 'aktif' ? 'bg-red-600' : 'bg-blue-500' }} rounded-md w-full py-2 text-white">{{ $itemGalih->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</button>

                </form>
            </div>
        </div>
    </div>
</div>
