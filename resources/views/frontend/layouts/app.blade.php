<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('frontend.layouts.partials.head')
    </head>
    <body>
        @include('frontend.layouts.partials.adminNavbar')
        @include('frontend.layouts.partials.topnav')

        <main class="content">
            @yield('content')
        </main>

        @include('frontend.layouts.partials.footer')
        <script src="{{ mix('js/app.js') }}"> </script>
    </body>
</html>