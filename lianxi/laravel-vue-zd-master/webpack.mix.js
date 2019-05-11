let mix = require('laravel-mix');
let path = require('path');

mix.webpackConfig({
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources', 'assets')
    }
  }
});

require(`${__dirname}/storage/laravel-mix/webpack.mix.${process.env.section}.js`);