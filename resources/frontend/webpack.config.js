const path = require("path");

module.exports = {
	mode: "none",
	output: {
		filename: "[name].js"
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					query: {
						presets: [
							["@babel/preset-env", { modules: false }]
						]
					}
				}
			}
		]
	},
	resolve: {
		alias: {
			"%modules%": path.resolve(__dirname, "src/blocks/modules"),
			"%components%": path.resolve(__dirname, "src/blocks/components")
		}
	},
	optimization: {
		splitChunks: {
			cacheGroups: {
				vendors: {
					test: /[\\/]node_modules[\\/]/,
					name: "vendor",
					chunks: "all",
					minChunks: 1
				}
			}
		}
	},
};