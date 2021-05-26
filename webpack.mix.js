const mix = require('laravel-mix');

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
    .sass('resources/sass/app.scss', 'public/css');

/* Combine CSS */
mix.styles([
	'public/css/app.css',
	'public/assets/css/bootstrap.min.css',
	'public/assets/css/icheck-bootstrap.css',
    'public/assets/css/font-awesome.min.css',
    'public/assets/css/flaticon.css',
    'public/assets/css/owl.carousel.css',
    'public/assets/css/owl.theme.default.min.css', 
    'public/assets/css/magnific-popup.css',
    'public/assets/css/slicknav.min.css',
    'public/assets/css/animate.css',
    'public/assets/css/style.css',
    'public/assets/css/custom.css',
    'public/assets/css/responsive.css',
    'public/assets/css/color/dark-green-color.css',
    'public/assets/css/bd-wizard.css',
    'public/assets/css/touchspin/jquery.bootstrap-touchspin.css',
    'node_modules/select2/dist/css/select2.min.css'
], 'public/css/app.css');

/* Combine JS */
mix.combine([
	'public/js/app.js',
	'public/assets/js/jquery-1.12.4.min.js',
	'public/assets/js/bootstrap.min.js',
	'public/assets/js/popper.min.js',
	'public/assets/js/owl.carousel.min.js',
	'public/assets/js/jquery.slicknav.min.js',
	'public/assets/js/jquery.magnific-popup.min.js',
	'public/assets/js/mixitup.min.js',
	'public/assets/js/wow.min.js',
	'public/assets/js/jquery.counterup.min.js',
	'public/assets/js/waypoints.min.js',
	'public/assets/js/active.js',
	'public/assets/js/jquery.steps.min.js',
	'public/assets/js/jquery.validate.js',
	'public/assets/js/bd-wizard.js',
	'public/assets/js/touchspin/jquery.bootstrap-touchspin.js',
	'node_modules/select2/dist/js/select2.min.js',
	'public/assets/js/jquery.imgcheckbox.js',
	'public/assets/js/sticky-sidebar/ResizeSensor.js',
	'public/assets/js/sticky-sidebar/theia-sticky-sidebar.js',
], 'public/js/app.js');

// In production environtment use versioning
if (mix.inProduction()) {                       
    mix.version();
}
