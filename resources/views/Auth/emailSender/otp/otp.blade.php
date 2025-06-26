@extends('layouts.landingPageLayouts')
@section('konten')
    <div class="w-full flex  justify-center items-center min-h-screen">

        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md ">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Enter OTP</h2>
            <p class="text-center text-gray-600 mb-6">We've sent a code to your phone number</p>
            <form method="POST" action="{{ route('otpCheck') }}">
                @csrf
                <div id="otpInput" class="flex justify-between mb-6">
                    <input name="1" type="text" maxlength="1"
                        class="w-12 h-12 text-center text-2xl border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" />
                    <input name="2" type="text" maxlength="1"
                        class="w-12 h-12 text-center text-2xl border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" />
                    <input name="3" type="text" maxlength="1"
                        class="w-12 h-12 text-center text-2xl border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" />
                    <input name="4" type="text" maxlength="1"
                        class="w-12 h-12 text-center text-2xl border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" />
                    <input name="5" type="text" maxlength="1"
                        class="w-12 h-12 text-center text-2xl border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" />
                    <input name="6" type="text" maxlength="1"
                        class="w-12 h-12 text-center text-2xl border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none" />
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200">Verify</button>
            </form>
            <p id="resentParagraph" class="text-center mt-6 text-gray-600">

            </p>
            <p id="paragraphResent" class="text-center mt-6 text-gray-600">
                Didn't receive the code?
                <a class="text-blue-500 resent cursor-pointer hover:underline">Resend</a>
            </p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const resentParagraph = $("#resentParagraph");
            const paragraphResent = $("#paragraphResent");
            $(".resent").on('click', function() {

                $.ajax({
                    url: "{{ route('ResentOtp') }}",
                    type: 'post',
                    data: {
                        resent: true
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        timeDiff();


                    },
                    error: function(data) {
                        console.log(data);

                    }
                });
            });

            function timeDiff() {

                $.ajax({
                    url: "{{ route('getTimeResent') }}",
                    type: 'get',
                    success: function(data) {
                        //  console.log(data.waktu);

                        const waktu = Date.parse(data.waktu ?? 0);

                        let interval = setInterval(() => {

                            const timeNow = new Date().getTime();
                            const distance = waktu - timeNow;

                            const menit = Math.floor((distance % (1000 * 60 * 60)) / (1000 *
                                60));

                            const detik = Math.floor((distance % (1000 * 60)) / 1000);

                            //  console.log(menit, detik);

                            console.log(menit);

                            if (distance < 0) {
                                paragraphResent.removeClass('hidden');
                                resentParagraph.text('');
                                clearInterval(interval);



                            } else {
                                paragraphResent.addClass('hidden');

                                resentParagraph.text(
                                    'Anda sudah meminta permintaan resent mohon tunggu sebentar ' +
                                    menit + ' : ' + detik + 'detik');
                            }

                        }, 1000);

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }



            const inputs = $("#otpInput input"); // Seleksi semua input di dalam elemen dengan ID 'otpInput'

            inputs.each(function(index, input) {
                $(input).on("input", function(e) {
                    if ($(this).val().length === 1 && index < inputs.length - 1) {
                        $(inputs[index + 1]).focus(); // Pindah ke input berikutnya
                    }
                });

                $(input).on("keydown", function(e) {
                    if (e.key === "Backspace" && $(this).val() === "" && index > 0) {
                        $(inputs[index - 1]).focus(); // Pindah ke input sebelumnya
                    }
                });
            });

            timeDiff();
        });
    </script>
@endsection
