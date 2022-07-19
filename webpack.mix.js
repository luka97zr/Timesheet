
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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');

    


let mix = require('laravel-mix');
const Dotenv = require('dotenv-webpack');

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

mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        devtool: 'source-map',
        module: {
            rules: [
                {
                    test: /\.styl$/,
                    use: [
                        'vue-style-loader',
                        'css-loader',{
                            loader: ['style-loader', 'css-loader', 'stylus-loader'],
                            options: {
                                implementation: require('sass'),
                                indentedSyntax: true // optional
                              },
                        }
                    ]
                }
            ]
        },
        output: {
            filename: 'js/app.js',
            chunkFilename: 'js/chunks/[name].[contenthash].js',
        },
        plugins: [
            new Dotenv()
        ],
        resolve: {
            alias: {
                '@': path.resolve('resources/sass'),
                '~': path.resolve('resources/js')
            }
        },
        watchOptions: {
            ignored: /node_modules/,
        },
    })
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .options({
        extractVueStyles: true,
        globalVueStyles: 'resources/sass/helper.scss',
        hmrOptions: {
            host: 'xtrade-core.local',
            port: 443,
        }
    })
    .version();
