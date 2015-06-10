var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
    
    //Kopijuojam font'us iš resources į public
    //.copy('../font-awesome/fonts', 'public/fonts')
    //.copy('../bootstrap/fonts', 'public/fonts')

    //Kompiliuojam LESS stilius
    .less([
    	'../bootstrap/less/bootstrap.less',
    	'../font-awesome/less/font-awesome.less'
	], 'public/css/style.css');

    mix.scripts([
        '../jquery/dist/jquery.js',
        '../bootstrap/dist/js/bootstrap.js',
        '../moment/min/moment-with-locales.min.js',
        '../moment-timezone/builds/moment-timezone-with-data.min.js',
        'date_format.js',
        'node_expand.js'
    ], 'public/js/scripts.js');
});
