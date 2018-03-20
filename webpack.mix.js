const mix = require('laravel-mix');
const settings = {
    jsPath: 'resources/assets/js/',
    sassPath: 'resources/assets/sass/'
};

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

mix.js(settings.jsPath + 'app.js', 'public/js')
    .sass(settings.sassPath + 'custom.scss', 'public/css');