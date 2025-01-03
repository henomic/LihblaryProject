@extends('Layouts.landingPageLayouts')

@section('konten')
    <section class="min-h-screen flex flex-1 justify-center items-center">
        <div
            class="bg-white w-[50rem]  flex justify-start py-14 border  border-slate-100 items-center p-8  flex-col shadow-lg">
            <h3 class="text-slate-900 font-semibold w-full text-start text-2xl">Daftar member</h3>

            <form action="{{ route('auth.store') }}" enctype="multipart/form-data" class="w-full gap-6 flex flex-col"
                method="post">
                @csrf
                <div class="flex md:flex-row gap-4 mt-6 flex-col">
                    <div class="flex  w-full gap-2 flex-col">
                        <label for="" class="text-slate-600 font-semibold ">Nama lengkap</label>
                        <input type="text" required name="nama" class="py-1  w-full px-1 border border-slate-300"
                            id="">
                    </div>
                    <div class="flex  w-full gap-2 flex-col">
                        <label for="" class="text-slate-600 font-semibold ">Nik</label>
                        <input type="text" required name="nik" class="py-1  w-full px-1 border border-slate-300"
                            id="">
                    </div>
                </div>

                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">username</label>
                    <input type="text" required name="username" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>
                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">email</label>
                    <input type="email" required name="email" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>
                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">alamat</label>
                    <input type="text" required name="alamat" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>
                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">Password</label>
                    <input type="Password" required name="password" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>
                <div class="flex  w-full gap-2 flex-col">
                    <label for="" class="text-slate-600 font-semibold ">foto anda (wajib menggunakan foto muka
                        asli)</label>
                    <input type="file" required name="foto" class="py-1  w-full px-1 border border-slate-300"
                        id="">
                </div>
                <div class="flex w-full gap-4 flex-col">
                    <button class="text-white bg-blue-700 w-full py-2 ">Daftar</button>

                    <p class="text-base text-slate-800">Jika sudah mempunyai akun member bisa untuk <a
                            class="text-base font-semibold text-blue-500" href="{{ route('auth.index') }}">Login
                            disisni</a> </p>
                    {{-- <a href="" class="text-white bg-slate-600 flex justify-center w-full py-2 ">Daftar</a> --}}
                </div>
            </form>


            @foreach ($errors->all() as $eror)
                {{ $eror }}
            @endforeach
        </div>
    </section>
@endsection
