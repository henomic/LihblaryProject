<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href=" {{ }}"> --}}

    <style>
        {{ file_get_contents('css/print.css') }}
    </style>
</head>

<body>
    @yield('konten')
</body>

</html>
