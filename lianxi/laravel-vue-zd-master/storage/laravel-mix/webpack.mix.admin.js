let mix = require('laravel-mix');

let path = require('path')

mix.webpackConfig({
  output: {
    publicPath: '',
    chunkFilename: `js/admin/chunk/chunk[name].${ mix.inProduction() ? '[chunkhash].' : '' }js${ mix.inProduction() ? '' : '?[chunkhash]' }`
  }
});

mix.js('resources/assets/admin/js/app.js', 'public/js/admin');

mix.extract([
  'axios',
  'vue',
  'vue-router',
  'iview'
]);

mix.autoload({
  vue: ['Vue']
});

if (mix.inProduction()) {
  mix.version();
}

mix.babelConfig({});

mix.sass('resources/assets/admin/sass/app.scss', 'public/css/admin').options({
  processCssUrls: true
});

mix.copyDirectory('node_modules/iview/dist/styles/', 'public/css/admin');
mix.copyDirectory('resources/assets/admin/images', 'public/images/admin');