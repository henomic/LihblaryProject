@extends('Layouts.landingPageLayouts')

@section('konten')
    <section class="min-h-screen flex flex-1 justify-center items-center">
        <div
            class="bg-white w-[30rem] flex justify-start py-14 border  border-slate-100 items-center p-8  flex-col shadow-lg">
            <h3 class="text-slate-900 font-semibold  text-2xl">Login</h3>

            <form action="{{ route('LoginCek') }}" class="w-full gap-6 flex flex-col" method="post">
                @csrf
                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">Email</label>
                    <input type="email" required name="email" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>
                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">Password</label>
                    <input type="password" required name="password" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>

                <div class="flex w-full gap-4 flex-col">
                    <button class="text-white bg-blue-700 w-full py-2 ">Login</button>

                    <p class="text-sm text-slate-800">Atau jika belum mempunyai akun bisa <a
                            class="text-base font-semibold text-blue-500" href="{{ route('auth.create') }}">Daftar
                            disisni</a> </p>
                    {{-- <a href="" class="text-white bg-slate-600 flex justify-center w-full py-2 ">Daftar</a> --}}
                </div>
            </form>
        </div>
    </section>
@endsection
