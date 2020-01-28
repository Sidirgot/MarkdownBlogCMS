const mix = require('laravel-mix');

const tailwindcss = require('tailwindcss');

mix.disableNotifications();

mix.js('resources/js/frontend/app.js', 'public/js')
    .js('resources/js/backend/main.js', 'public/js')
    .sass('resources/sass/markdown.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        tailwindcss('resources/js/tailwindcss.js')
    ]);

mix.version();