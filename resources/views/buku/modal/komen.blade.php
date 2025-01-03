  <div id="komenModal" class="hidden gap-3 fixed top-0 bg-black bg-opacity-50 inset-0  items-center justify-center">
      <form class=" bg-white py-6 px-4 w-[30rem] flex flex-col "
          action="{{ $ulasanGalih !== null ? route('ulasan.update', $ulasanGalih->ulasanId ?? '') : route('ulasan.store') }}"
          method="post">
          @csrf

          @if ($ulasanGalih !== null)
              @method('put')
          @endif

          <div class="flex justify-between">
              <h3 class="text-slate-600 text-xl font-semibold">Tambah Modaltar</h3>
              <a class="komenBut text-slate-600  text-xl cursor-pointer  font-semibold">
                  X
              </a>
          </div>

          <h3 class="text-slate-600 mt-8 font-semibold">Ulasan buku ini</h3>

          <div class="flex mt-3 gap-4">
              <svg data-value="1" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                  fill="#0000" stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide star lucide-star">
                  star
                  <path
                      d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
              </svg>
              <svg data-value="2" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                  fill="#0000" stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide star lucide-star">
                  <path
                      d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
              </svg>
              <svg data-value="3" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                  fill="#0000" stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide star lucide-star">
                  <path
                      d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
              </svg>
              <svg data-value="4" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                  fill="#0000" stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide star lucide-star">
                  <path
                      d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
              </svg>
              <svg data-value="5" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                  fill="#0000" stroke="#D5AB55" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide star lucide-star">
                  <path
                      d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
              </svg>
          </div>


          <textarea name="komenGalih" class="p-1 isiKomentar  mt-4 w-full rounded-md border border-slate-400 resize-none"
              cols="30" rows="10"></textarea>

          <input type="text" hidden name="starGalih" id="star">

          <button name="bukuId" value="{{ $bukuGalih->bukuId }}" class="bg-blue-500 text-white mt-6 py-2">Tambah
              komentar</button>

      </form>


      <script>
          document.querySelectorAll('.isiKomentar').forEach(element => {
              element.value = @json($ulasanGalih->ulasan ?? '')
          });
      </script>
  </div>
