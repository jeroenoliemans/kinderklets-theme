const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    entry: ['./js/kinderklets.js', './sass/style.scss'],
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'build')
    },
    module: {
        rules: [
            // {
            //     test: /\.svg$/,
            //     loader: 'file-loader'
            // },
            {
                test: /\.(eot|svg|ttf|woff|woff2)$/,
                loader: 'file-loader'
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    //fallback: 'style-loader',
                    //resolve-url-loader may be chained before sass-loader if necessary
                    use: ['css-loader', 'sass-loader']
                })
            },
            // {
            //     test: /\.libs\.js$/,
            //     loader: 'script-loader'
            // }
        ]
    },
    plugins: [
        new ExtractTextPlugin('style.css')
    ],
    watch: true,
    watchOptions: {
        poll: 1000
    }
};