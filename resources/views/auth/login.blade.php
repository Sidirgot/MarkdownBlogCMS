<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>Login</title>
    </head>
    <body class="bg-gray-200 min-h-screen">
            <section class="flex justify-center items-center min-h-screen">
                <div class="bg-white rounded shadow-xl w-full md:w-1/3 mx-2 md:mx-0 text-center">
                    <div class="flex justify-center items-center py-6">
                        <img class="h-20 mr-4" src="/assets/logo.png" alt="sidirgot logo">
                        <span class="text-2xl text-bold text-sidirgot">Sidirgot</span>
                    </div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-600 rounded text-white my-3 mx-6 p-3">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form {{ route('login') }} " method="POST">
                        @csrf
                        <div class="my-8">
                            <input type="text" name="email" placeholder="email" class="px-4 py-2 rounded shadow  w-2/3">
                        </div>

                        <div class="mb-8">
                            <input type="password" name="password" placeholder="password" class="px-4 py-2 rounded shadow  w-2/3">
                        </div>

                        <div class=" bg-gray-200 h-32 flex justify-center items-center">
                            <button class="text-white bg-teal-500 px-4 py-2 rounded shadow hover:bg-teal-400">Log In</button>
                        </div>
                    </form>
                </div>
            </section>
    </body>
</html>