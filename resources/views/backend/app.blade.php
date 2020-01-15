<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>Sidirgot</title>
    </head>
    <body class="bg-main-dark">

        <main id="backend">
            <app><app>
        </main>

        <script src="{{ mix('js/main.js') }}"> </script>
    </body>
</html>