

// Include gulp
var gulp = require('gulp'); 

// Include Our Plugins
var sass = require('gulp-sass');
var minifyCSS = require('gulp-minify-css');
var concat = require('gulp-concat');
var copy = require('gulp-copy');
var uglify = require('gulp-uglify');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var watch = require('gulp-watch');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');


/**
 * 
 * @Task Managerment
 * 
 */

//watch task
gulp.task('watch', function() {   
    gulp.watch('assets/*.scss', ['gulpSass']);
    gulp.watch('assets/**/*.scss', ['gulpSass']);
    gulp.watch('assets/***/*.scss', ['gulpSass']);    
});

//Concat all *JS Files
gulp.task('scriptsConcat', function() {
  return gulp.src(['assets/javascripts/*.js'])
    .pipe(concat('app.min.js'))    
    .pipe(gulp.dest('assets/javascripts'));
});

//Compass task

gulp.task('gulpSass', function() {
    gulp.src(['assets/**/*.scss', 'assets/*.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCSS())
        .pipe(gulp.dest('assets/stylesheets'));
});

/**********************Install*********************/

gulp.task('coppyJquery', function(){
    return gulp.src(['bower_components/jquery/dist/jquery.min.js'])
    .pipe(gulp.dest('assets/javascripts'));
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
/*************************END Install******************/

/**************************BUILD**********************/

//Clean
gulp.task('clean', function(){
    return gulp.src('dist/*', {read: false})
        .pipe(clean());
});

//styles
gulp.task('copyStyles', function(){
    return gulp.src(['assets/style.css'])
    .pipe(gulp.dest('dist'));
});

//Javascript
gulp.task('copyScripts', function(){
    return gulp.src(['assets/javascripts/app.min.js'])
    .pipe(uglify())
    .pipe(gulp.dest('dist/javascripts'));
});

//Fonts
gulp.task('copyFonts', function(){
    return gulp.src(['assets/fonts/*', 'assets/fonts/**/*'])
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

//Theme
gulp.task('copyTheme', function(){
    return gulp.src(['*.php', '**/*.php'])
    .pipe(gulp.dest('dist'));
});

/**************************END BUILD****************************/

// Default Task
gulp.task('default', ['gulpSass', 'scriptsConcat', 'watch']);

//Gulp install resource
gulp.task('install', ['coppyJquery', 'coppyBootstrapStyle', 'coppyBootstrapScript', 'coppyBootstrapFont']);

/**
 * Implement task synchronized
 * - After clean all file in dist folder, other task will be run.
 */
gulp.task('build',['clean'], function(){
    gulp.start(['copyFonts','copyStyles', 'copyScripts', 'imagemin', 'copyTheme']);
});