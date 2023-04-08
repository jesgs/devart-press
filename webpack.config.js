const webpack = require('webpack')
const path = require("path");
const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// const dotenv = require('dotenv').config({path: __dirname + '/.env'});

const environment = ({
	'process.env': {
		NODE_ENV: '"development"'
	},
})

module.exports = {
	...defaultConfig,
	entry: "./assets/admin/ui/src/index.tsx",
	resolve: {
		...defaultConfig.resolve,
		extensions: ['.tsx']
	},
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.tsx$/,
				use: [{
					loader: 'ts-loader',
					options: {
						// You can specify any custom config
						configFile: 'tsconfig.json',

						// See note under "issues" for details
						// Speeds up by skipping type-checking. You can still use TSC for that.
						transpileOnly: true,
					}
				}],
				exclude: /node_modules/,
			}
		],
	},
	mode: 'development',
	output: {
		...defaultConfig.output,
		filename: 'index.js',
		path: path.resolve(__dirname, 'assets'),
	},
	plugins: [
		...defaultConfig.plugins,
		new MiniCssExtractPlugin({
			filename: `[name].css`,
		}),
		new webpack.DefinePlugin(environment),
	],
};
