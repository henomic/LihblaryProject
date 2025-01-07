 @extends('layouts.landingPageLayouts')
 @section('konten')
     <div class="w-full flex  justify-center items-center min-h-screen">

         <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md ">
             <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Enter OTP</h2>
             <p class="text-center text-gray-600 mb-6">We've sent a code to your phone number</p>
             <form method="POST" action="{{ route('otpCheck') }}">
                 @csrf
                 <div class="flex justify-between mb-6">
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
             <p class="text-center mt-6 text-gray-600">
                 Didn't receive the code?
                 <a href="#" class="text-blue-500 hover:underline">Resend</a>
             </p>
         </div>
     </div>
 @endsection
