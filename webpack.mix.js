let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .copy('node_modules/reveal.js/js/reveal.js', 'public/js/reveal.js')
   .copy('node_modules/reveal.js/css/reveal.css', 'public/css/reveal.css')
   .sass('resources/assets/sass/app.scss', 'public/css/app.css')
   .sass('resources/assets/sass/print.scss', 'public/css/print.css')
   .sass('resources/assets/sass/slide.scss', 'public/css/slide.css');
