var path = require('path');
var webpack = require('webpack');
require('dotenv').config({silent: true});
var config = require('./config');
var utils = require('./utils');
var projectRoot = path.resolve(__dirname, '../../');

var env = process.env.NODE_ENV;

var envMapping = {
    'process.env': {
        'NODE_ENV': JSON.stringify(process.env.NODE_ENV)
    }
};

for (var key in process.env) {
    if (process.env.hasOwnProperty(key) && key.substring(0, 12) == 'RADIOPHONIX_') {
        envMapping['process.env'][key] = JSON.stringify(process.env[key]);
    }
}

// check env & config/index.js to decide weither to enable CSS Sourcemaps for the
// various preprocessor loaders added to vue-loader at the end of this file
var cssSourceMapDev = (env === 'development' && config.dev.cssSourceMap);
var cssSourceMapProd = (env === 'production' && config.build.productionSourceMap);
var useCssSourceMap = cssSourceMapDev || cssSourceMapProd;

module.exports = {
    entry: {
        app: './resources/assets/js/main.js'
    },
    output: {
        path: config.build.assetsRoot,
        publicPath: process.env.NODE_ENV === 'production' ? config.build.assetsPublicPath : config.dev.assetsPublicPath,
        filename: '[name].js'
    },
    resolve: {
        extensions: ['', '.ts', '.js', '.vue'],
        fallback: [path.join(__dirname, '../../../node_modules')],
        alias: {
            '~': path.resolve(__dirname, '../js')
        }
    },
    resolveLoader: {
        fallback: [path.join(__dirname, '../../../node_modules')]
    },
    module: {
        loaders: [
            {
                test: /\.scss$/,
                loader: 'postcss-loader!sass-loader?sourceMap'
            },
            {
                test: /\.vue$/,
                loader: 'vue'
            },
            {
                test: /\.js$/,
                loader: 'babel',
                include: projectRoot,
                exclude: /node_modules/
            },
            {
                test: /\.ts?$/,
                loader: 'ts-loader',
                include: projectRoot,
                exclude: /node_modules/
            },
            {
                test: /\.json$/,
                loader: 'json'
            },
            {
                test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
                loader: 'url',
                query: {
                    limit: 10000,
                    name: utils.assetsPath('img/[name].[hash:7].[ext]')
                }
            },
            {
                test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
                loader: 'url',
                query: {
                    limit: 10000,
                    name: utils.assetsPath('fonts/[name].[hash:7].[ext]')
                }
            }
        ]
    },
    vue: {
        loaders: utils.cssLoaders({sourceMap: useCssSourceMap}),
        postcss: [
            require('autoprefixer')({
                browsers: ['last 2 versions']
            })
        ]
    },
    plugins: [
        new webpack.DefinePlugin(envMapping)
    ]
};
