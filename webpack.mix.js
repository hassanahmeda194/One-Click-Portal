const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .babelConfig({
        presets: ['@babel/preset-env'],
    })
    .options({
        processCssUrls: false,
    })
    .sourceMaps();
mix.js('resources/js/notification.js', 'public/js');

if (mix.inProduction()) {
    mix.version();
}
