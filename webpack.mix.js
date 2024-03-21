const mix = require('laravel-mix');

mix.setPublicPath('frontend/web/public')
	.setResourceRoot('/public')
	.js('frontend/web/redesign/source/js/main.js', 'dist/js')
	.sass('frontend/web/redesign/source/scss/talwind.scss', 'dist/css')
	.sass('frontend/web/redesign/source/scss/main.scss', 'dist/css')
	.options({
		fileLoaderDirs:  {
			fonts: 'dist/fonts'
		}
	})
	.extract(['vue'], 'dist/js/vendor.js')
	.vue()
	.version()
;