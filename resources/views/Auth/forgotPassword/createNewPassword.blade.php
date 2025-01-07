<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-semibold text-gray-900">
                    Reset Password
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Masukkan password baru Anda
                </p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('CreatePassword') }}" method="POST">
                @csrf
                <div class="rounded-md flex flex-col gap-3">
                    <div>
                        <label for="new-password" class="sr-only">Password Baru</label>
                        <input id="new-password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-lihblary-blue focus:border-lihblary-blue focus:z-10 sm:text-sm"
                            placeholder="Password baru">
                    </div>
                    <div>
                        <label for="confirm-password" class="sr-only">Konfirmasi Password</label>
                        <input id="confirm-password" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-lihblary-blue focus:border-lihblary-blue focus:z-10 sm:text-sm"
                            placeholder="Konfirmasi password">
                    </div>
                </div>

                @foreach ($errors->all() as $item)
                    <a class="text-base text-red-500">
                        {{ $item }}
                    </a>
                @endforeach
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lihblary-blue">
                        Simpan Password Baru
                    </button>
                </div>
            </form>
            <div class="text-center">
                <a href="#" class="font-medium text-lihblary-blue hover:text-lihblary-dark-blue">
                    Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
</body>


</html>
