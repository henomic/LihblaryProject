<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">OTP untuk Registrasi Anda Di Perpustakaan Lihblary
        </h2>
        <p class="text-gray-600 text-lg mb-4">Halo, {{ $send['email'] }}</p>
        <p class="text-gray-600 mb-6">Berikut adalah kode OTP untuk menyelesaikan registrasi Anda:</p>

        <div class="bg-gray-200 p-4 rounded-lg text-center text-3xl font-semibold text-green-600">

            {{ $send['otp'] }}
        </div>

        <p class="text-gray-600 mt-6">Silakan masukkan kode OTP di aplikasi untuk melanjutkan pendaftaran Anda.</p>

        <div class="mt-8 text-center text-sm text-gray-500">
            <p>Jika Anda tidak merasa meminta OTP ini, abaikan email ini.</p>
        </div>
    </div>
</body>

</html>
