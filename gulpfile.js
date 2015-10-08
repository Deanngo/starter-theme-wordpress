// Include gulp
var gulp = require('gulp'); 

// Include Our Plugins
var compass = require('gulp-compass');
var minifyCSS = require('gulp-minify-css');
var concat = require('gulp-concat');
var copy = require('gulp-copy');
var uglify = require('gulp-uglify');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var watch = require('gulp-watch');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');


//Task Fire Theme

//watch task
//gulp.task('watch', function() {   
//    gulp.watch('assets/*.scss', ['compass']);
//    gulp.watch('assets/**/*.scss', ['compass']);
//    gulp.watch('assets/***/*.scss', ['compass']);
//    gulp.watch('assets/javascripts/*.js');
//});

gulp.task('scriptsConcat', function() {
  return gulp.src(['assets/javascripts/*.js'])
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/javascripts'));
});

//Compass task
gulp.task('compass', function() {
  gulp.src('assets/*.scss')
    .pipe(compass({
      css: 'assets',
      sass: 'assets'            
    }))
    .pipe(minifyCSS())
    .pipe(gulp.dest('assets'));
});


gulp.task('coppyBootstrapStyle', function(){
    return gulp.src(['bower_components/bootstrap-sass/assets/stylesheets/**'])
    .pipe(gulp.dest('assets/stylesheets'));
});

gulp.task('coppyBootstrapScript', function(){
    return gulp.src(['bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js'])
    .pipe(gulp.dest('assets/javascripts'));
});

gulp.task('coppyBootstrapFont', function(){
    return gulp.src(['bower_components/bootstrap-sass/assets/fonts/**'])
    .pipe(gulp.dest('assets/fonts'));
});


/**************************BUILD*******************/

//Clean
gulp.task('clean', function(){
    return gulp.src('dist/*', {read: false})
        .pipe(clean());
});

//styles
gulp.task('copyStyles', function(){
    return gulp.src(['assets/styles.css'])
    .pipe(gulp.dest('dist'));
});

//Javascript
gulp.task('copyScripts', function(){
    return gulp.src(['assets/javascripts/*'])
    .pipe(gulp.dest('dist/javascripts'));
});

//Fonts
gulp.task('copyFonts', function(){
    return gulp.src(['assets/fonts/*', 'assets/fonts/*'])
    .pipe(gulp.dest('dist/fonts'));
});

//Minifier images
gulp.task('imagemin', function () {
    return gulp.src('assets/images/*')
        .pipe(imagemin({
            progressive: true,
            use: [pngquant()]
        }))
        .pipe(gulp.dest('dist/images'));
});

//END COPY

// Default Task
gulp.task('default', ['compass', 'scriptsConcat']);

//Gulp install resource
gulp.task('install', ['coppyBootstrapStyle', 'coppyBootstrapScript', 'coppyBootstrapFont']);

/**
 * run Build Task
 * Prepare to deploy
 */
gulp.task('build', ['clean','copyStyles', 'copyScripts', 'copyFonts', 'imagemin']);
