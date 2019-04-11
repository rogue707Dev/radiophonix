// https://github.com/shelljs/shelljs
require('./check-versions')();
require('shelljs/global');
env.NODE_ENV = 'development';

var path = require('path');
var config = require('./config');

config.build.env.NODE_ENV = '"development"';

var ora = require('ora');
var webpack = require('webpack');
var webpackConfig = require('./webpack.prod.conf');

var spinner = ora('building for dev...');
spinner.start();

var assetsPath = path.join(config.build.assetsRoot, config.build.assetsSubDirectory);
rm('-rf', assetsPath);
mkdir('-p', assetsPath);
cp('-R', 'resources/assets/static/*', assetsPath);

webpack(webpackConfig, function (err, stats) {
    spinner.stop();
    if (err) throw err;
    process.stdout.write(stats.toString({
        colors: true,
        modules: false,
        children: false,
        chunks: false,
        chunkModules: false
    }) + '\n')
});
