const mix = require('laravel-mix');
const glob = require('glob');
const path = require('path');

require('laravel-mix-stylelint');

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

const scssFiles = path.resolve(__dirname, 'resources/sass/*.scss')
const jsFiles = path.resolve(__dirname, 'resources/js/*.js')

glob.sync(scssFiles).map(function (file) {
    mix.sass(file, 'public/css').options({
        processCssUrls: false,
        postCss: [
            require('css-mqpacker')(),
            require('css-declaration-sorter')({
                order: 'smacss'
            })
        ],
        autoprefixer: {
            options: {
                browsers : [
                    'last 2 versions',
                ],
                cascade: false
            }
        }
    })
})

glob.sync(jsFiles).map(function (file) {
    mix.js(file, 'public/js')
  })

mix
    .disableNotifications()
    .webpackConfig({
        module: {
            rules: [
                {
                    enforce: 'pre',
                    test: /\.(js|vue)$/,
                    loader: 'eslint-loader',
                    exclude: /node_modules/,
                },
                {
                    test: /\.scss/,
                    loader: 'import-glob-loader'
                },
            ]
        },
        resolve: {
            modules: [
                path.resolve('./resources/'),
                'node_modules'
            ]
        }
    })
    .stylelint({configFile: './.stylelintrc', files: ['**/*.scss']})

if (mix.inProduction()) {
    mix.version();
}
