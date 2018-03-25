const mix = require('laravel-mix');
const settings = {
    jsPath: 'resources/assets/js/',
    sassPath: 'resources/assets/sass/',
    cssPath: 'resources/assets/css/',
    fontsPath: 'resources/assets/fonts/'
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
const vendors = [
    'jquery',
    'uikit',
    'datatables.net'
];

mix.extract(vendors, 'public/js/vendor.js')
    .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery', 'jquery'],
    UIKit: ['UIKit', 'window.UIKit'],
    });


mix.js(settings.jsPath + 'app.js', 'public/js/app.js')
    .sass(settings.sassPath + 'custom.scss', 'public/css');

mix.js(settings.jsPath + 'app/main.js', 'public/js/main.js');
mix.js(settings.jsPath + 'uikit.min.js', 'public/js/uikit.min.js');

mix.styles(settings.cssPath + 'uikit.min.css', 'public/css/uikit.min.css');

mix.copy(settings.fontsPath + 'ionicons.eot', 'public/fonts/ionicons.eot');
mix.copy(settings.fontsPath + 'ionicons.svg', 'public/fonts/ionicons.svg');
mix.copy(settings.fontsPath + 'ionicons.ttf', 'public/fonts/ionicons.ttf');
mix.copy(settings.fontsPath + 'ionicons.woff', 'public/fonts/ionicons.woff');

mix.styles(settings.cssPath + 'ionicons.min.css', 'public/css/ionicons.min.css');