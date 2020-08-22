const mix = require('laravel-mix');

const tailwindcss = require('tailwindcss');

require('laravel-mix-purgecss');

mix.disableNotifications();

mix.js('resources/js/frontend/app.js', 'public/js')
    .js('resources/js/backend/main.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('resources/js/tailwindcss.js') ],
    })
    .purgeCss();

mix.version();