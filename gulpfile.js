var gulp  = require('gulp');
var elixir = require('laravel-elixir');
var imagemin = require('gulp-imagemin');

gulp.task('default', function() {
    return elixir(function(mix) {
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
            '../emojify.js/dist/js/emojify.js',
            'emoji.js',
            'markdown_parser.js',
            'markdown.js',
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
        mix.version(["public/css/style.css", "public/js/scripts.js"])
        mix.copy('resources/assets/font-awesome/fonts', 'public/build/fonts')
        mix.copy('resources/assets/bootstrap/fonts', 'public/build/fonts');
    });
});

gulp.task('imagemin', function() {
    return gulp.src('public/images/avatars/**/*.png')
           .pipe(imagemin({
                progressive: true
           }))
           .pipe(gulp.dest('public/images/avatars/'));
});