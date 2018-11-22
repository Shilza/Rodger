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

/**
 * .js([
 'resources/js/app.js',
 'resources/js/login.js',
 ], 'public/js')
 */

mix.styles([
        'resources/css/general.css',
        'resources/css/login-form.css',
        'resources/css/toast.css',
    ], 'public/css/app.css');

mix.disableNotifications();