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

    



 mix.scripts([
        'resources/js/jquery.min.js',
        'resources/js/jquery.validate.min.js',
        'resources/js/jquery.dataTables.min.js',
        'resources/js/dataTables.bootstrap4.min.js',
        'resources/js/popper.min.js',
        'resources/js/bootstrap.js',
        'resources/js/bootstrap.min.js',
        'resources/js/main.js'
        
    ], 'public/js/app.js');

    mix.styles([
        'resources/css/style.css',
        'resources/css/bootstrap.min.css',
        'resources/css/dataTables.bootstrap4.min.css',
        'resources/css/jquery.dataTables.min.css',
        'resources/css/all.css'
    ], 'public/css/app.css');
