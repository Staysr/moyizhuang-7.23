let mix = require('laravel-mix');

let path = require('path')

mix.webpackConfig({
  output: {
    publicPath: '',
    chunkFilename: `js/${process.env.section}/chunk/chunk[name].${ mix.inProduction() ? '[chunkhash].' : '' }js`
  }
});


const loaders = ['vue-style-loader', {
  loader: 'style-loader'
}, {
  loader: 'css-loader'
}
  , {
    loader: 'px2rem-loader',
    options: {
      remUnit: 75,
      remPrecision: 8
    }
  }
];

mix.options({
  vue: {
    loaders: {
      less: [...loaders, {
        loader: 'less-loader'
      }],
      scss: [...loaders, {
        loader: 'sass-loader'
      }],
      sass: [...loaders, {
        loader: 'sass-loader'
      }],
      css: [...loaders],
      js: {
        loader: 'babel-loader',
        options: Config.babel()
      }
    }
  }
});

class babel {
  webpackRules() {
    return {
      test: /\.js$/,
      loaders: ['babel']
    };
  }
}

mix.extend('foo', new babel());

mix.js(`resources/assets/${process.env.section}/js/app.js`, `public/js/${process.env.section}`);

mix.extract([
  'axios',
  'vue',
  'vue-router',
]);

mix.autoload({
  vue: ['Vue']
});

if (mix.inProduction()) {
  mix.version();
}

mix.babelConfig({});

mix.sass(`resources/assets/${process.env.section}/sass/app.scss`, `public/css/${process.env.section}`).options({
  processCssUrls: true
});

mix.copyDirectory(`resources/assets/${process.env.section}/images`, `public/images/${process.env.section}`);