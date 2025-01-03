<!-- Main modal -->
<div id="tolak{{ $itemGalih->peminjamanId }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="bg-black inset-1 absolute bg-opacity-50 top-0 left-0 right-0 bottom-0"></div>
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow :bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 :text-white">
                    {{ $itemGalih->status === 'booking' ? 'Apakah anda ingin menolak peminjam ini?' : 'Apakah buku ada  kerusakan? ' }}


                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white"
                    data-modal-hide="tolak{{ $itemGalih->peminjamanId }}">


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
                <form action="{{ route('adminKonfirmasiPeminjaman.update', $itemGalih->peminjamanId) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('put')
                    @if ($itemGalih->status === 'booking')
                        <button type="submit" name="param" value="tolak"
                            class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Ya</button>
                    @endif
                    @if ($itemGalih->status === 'dipinjam')
                        @if ($itemGalih->status === 'dipinjam' and $diffGalih < 0)
                            <input hidden name="galihdendaTelat" class="denda" value="{{ abs($diffGalih) }}"
                                type="text">
                        @endif
                        <div class="flex  mt-6 flex-col">
                            <label for="">Keterangan</label>
                            <input type="text" name="keterangan"
                                class="w-full border border-slate-500 p-1 rounded-md" id="">
                        </div>
                        <div class="flex  mt-6 flex-col">
                            <label for="">Jumlah denda</label>
                            <input name="hargaDenda" value=""
                                class="denda w-full border border-slate-500 p-1 rounded-md" type="text">
                        </div>
                        <div class="flex  mt-6 flex-col">
                            <label for="">Status buku</label>
                            <select name="statusBuku" class="w-full border border-slate-500 p-1 rounded-md"
                                id="">
                                <option value="masih bisa di pakai">Buku masih bisa di pakai</option>
                                <option value="hilang/rusak">Buku sudah tak bisa di pakai</option>
                            </select>
                        </div>
                        <button type="submit" name="param" value="denda"
                            class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none mt-6 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Ya</button>
                    @endif


                </form>
            </div>
        </div>
    </div>
</div>
