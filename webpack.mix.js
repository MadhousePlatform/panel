const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .disableSuccessNotifications()
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps()
        .browserSync({
            https: {
                key: "/Users/sketch/.config/valet/Certificates/madhouse.test.key",
                cert: "/Users/sketch/.config/valet/Certificates/madhouse.test.crt"
            },
            proxy: "https://madhouse.test",
            ui: {
                port: 9070
            }
        });
}
