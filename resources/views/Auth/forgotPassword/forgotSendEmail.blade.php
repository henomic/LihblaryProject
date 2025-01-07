@extends('layouts.landingPageLayouts')
@section('konten')


    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md  w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-blue-700">
                    Lupa Password
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Masukkan email Anda untuk mereset password
                </p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('forgotPasswordCheck') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Alamat Email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-lihblary-blue focus:border-lihblary-blue focus:z-10 sm:text-sm"
                            placeholder="Alamat email">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lihblary-blue">
                        Kirim Link Reset Password
                    </button>
                </div>
            </form>
            <div class="text-center">
                <a href="#" class="font-medium  text-lihblary-blue hover:text-blue-500 ">
                    Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
@endsection
