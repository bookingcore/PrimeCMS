const mix = require('laravel-mix');

mix.webpackConfig({
    output: {
        path: __dirname + '/dist',
    },
});
mix.disableSuccessNotifications();

mix.sass('scss/app.scss', 'css');

