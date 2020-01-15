<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">

        <title>Sidirgot</title>
    </head>
    <body class="bg-gray-200">
        <div class="bg-blue-500 text-white h-12 flex items-center justify-between px-8">
            <a href="">Sidirgot</a>

            @guest
                <a href="{{ route('login') }}" class="hover:opacity-75">Login</a>
            @endguest

            @auth
                <a href="{{ url('/manage/posts') }}" class="hover:opacity-75">Dashboard</a>
            @endauth
        </div>

        <script src="{{ mix('js/app.js') }}"> </script>
    </body>
</html>