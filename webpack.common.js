const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const { VueLoaderPlugin } = require("vue-loader");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require('autoprefixer');

const __base = path.resolve(__dirname);
const __src = path.resolve(__base, "src");

module.exports = {
  entry: {
    home: {
      import: path.resolve(__src, "main.js"),
      dependOn: 'shared',
    },
    shared: ["vue"],
  },

  output: {
    filename: "[name].js",
    path: path.resolve(__base, "dist"),
    chunkFilename: "[name].js",
    clean: true,
  },
  plugins: [
    new VueLoaderPlugin(),
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css",
      ignoreOrder: false,
    }),
    // new HtmlWebpackPlugin(),
  ],
  // optimization: {
  //   moduleIds: "deterministic",
  //   runtimeChunk: "single",
  //   splitChunks: {
  //     cacheGroups: {
  //       vendor: {
  //         test: /[\\/]node_modules[\\/]/,
  //         name: "vendors",
  //         priority: -10,
  //         chunks: "all"
  //       }
  //     }
  //   }
  // },

  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: "vue-loader",
      },
      {
        test: /\.(c|sc|sa)ss$/i,
        use: [
            // "style-loader",
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              esModule: false,
            }
          },
          "css-loader",
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: () => [autoprefixer()]
              }
            }
          },
          "sass-loader",
        ]
      },
      {
        test: /\.(eot|svg|ttf|woff|woff2|png|jpe?g|gif)$/i,
        loader: "file-loader",
        options: {
          outputPath: "assets",
          esModule: false,
        }
      },
    ],
  },
};
