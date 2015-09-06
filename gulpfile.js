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
    mix.copy('../font-awesome/fonts', 'public/fonts');
    mix.copy('../bootstrap/fonts', 'public/fonts');
    mix.less([
        //'../emojify.js/dist/css/sprites/emojify-emoticons.css',
        '../emojify.js/dist/css/basic/emojify.css',
    	'../bootstrap/less/bootstrap.less',
    	'../font-awesome/less/font-awesome.less',
        '../css/markdown.css',
        '../css/lightbox.css',
        '../css/highlight.css'
	], 'public/css/style.css');
    mix.scripts([
        '../jquery/dist/jquery.js',
        '../bootstrap/dist/js/bootstrap.js',
        '../moment/min/moment-with-locales.min.js',
        '../emojify.js/dist/js/emojify.js',
        'emoji.js',
        'markdown_parser.js',
        'markdown.js',
        'date_format.js',
        'lightbox.js',
        'lightbox_call.js',
        'textcomplete.js',
        'autocomplete.js',
        'jquery.autosize.min.js',
        'autosize.js',
        'vote.js',
        'node_expand.js',
        'highlight.js',
        'main.js'
    ], 'public/js/scripts.js');
});
