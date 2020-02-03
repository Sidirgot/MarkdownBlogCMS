<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('frontend.layouts.partials.head')
    </head>
    <body>
        @include('frontend.layouts.partials.adminNavbar')

        <main class="content">
            @include('frontend.layouts.partials.topnav')

            @yield('content')

            @include('frontend.layouts.partials.footer')
        </main>

        <script src="{{ mix('js/app.js') }}"> </script>
    </body>
</html>