<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <title> Kelompok2 | {{ $title }}</title>
</head>

<body>
    @if (!request()->is('login') && !request()->is('register'))
        @include('partials.navbar')
    @endif

    <main>
        @yield('container')
    </main>

    @if (!request()->is('login') && !request()->is('register'))
        <footer>
            <p>Kelompok2</p>
        </footer>
    @endif

    @yield('js')
</body>

</html>
