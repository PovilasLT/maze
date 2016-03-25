var gulp  = require('gulp');
var elixir = require('laravel-elixir');
var imagemin = require('gulp-imagemin');

elixir(function(mix) {
    mix.less('app.less');
    mix.browserify('app.js', 'public/js/app.js');
    mix.version(["public/css/app.css", "public/js/app.js"]).copy('resources/assets/fonts', 'public/build/fonts')
});

gulp.task('imagemin', function() {
    return gulp.src('public/images/avatars/**/*.png')
           .pipe(imagemin({progressive: true}))
           .pipe(gulp.dest('public/images/avatars/'));
});