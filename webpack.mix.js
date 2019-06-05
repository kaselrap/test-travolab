const mix = require('laravel-mix');

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

mix.js('resources/assets/js/main.js', 'public/js')
    .scripts([
        'resources/assets/sweetalert/dist/sweetalert.min.js',
        'resources/assets/vendor/select2/select2.min.js',
        'resources/assets/vendor/daterangepicker/moment.min.js',
        'resources/assets/vendor/daterangepicker/daterangepicker.js',
        'resources/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'resources/assets/js/main.js',
    ], 'public/js/script.js')
    .styles([
        'resources/assets/vendor/select2/select2.min.css',
        'resources/assets/vendor/daterangepicker/daterangepicker.css',
        'resources/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css',
        'resources/assets/css/style.css'
    ], 'public/css/main.css')
    .scripts([
        'resources/assets/sweetalert/dist/sweetalert.min.js',
        'resources/assets/vendor/jquery/jquery-3.2.1.min.js',
        'resources/assets/vendor/animsition/js/animsition.min.js',
        'resources/assets/vendor/bootstrap/js/popper.js',
        'resources/assets/vendor/bootstrap/js/bootstrap.min.js',
        'resources/assets/vendor/select2/select2.min.js',
        'resources/assets/vendor/daterangepicker/moment.min.js',
        'resources/assets/vendor/daterangepicker/daterangepicker.js',
        'resources/assets/vendor/daterangepicker/daterangepicker.js',
        'resources/assets/vendor/countdowntime/countdowntime.js',
        'resources/assets/js/main-contact.js',
    ], 'public/js/contact-script.js')
    .styles([
        'resources/assets/vendor/bootstrap/css/bootstrap.min.css',
        'resources/assets/vendor/animate/animate.css',
        'resources/assets/vendor/css-hamburgers/hamburgers.min.css',
        'resources/assets/vendor/animsition/css/animsition.min.css',
        'resources/assets/vendor/select2/select2.min.css',
        'resources/assets/vendor/daterangepicker/daterangepicker.css',
        'resources/assets/css/util.css',
        'resources/assets/css/main-contact.css'
    ], 'public/css/main-contact.css');
