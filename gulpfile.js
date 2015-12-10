

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

/**
 * @Description Watch all scss and javascript files to build
 */

gulp.task('watch', function() {   
    gulp.watch('assets/scss/*.scss', ['gulpSass']);
    gulp.watch('assets/scss/**/*.scss', ['gulpSass']);
    gulp.watch('assets/scss/***/*.scss', ['gulpSass']);
    gulp.watch('assets/javascripts/app.js', ['concat']);
});

/**
 * @Description Concat all javascript files to a file with compress
 */

gulp.task('concat', function() {
  return gulp.src(['assets/javascripts/jquery.min.js', 'assets/javascripts/bootstrap.min.js', 'assets/javascripts/app.js'])
    .pipe(concat('app.min.js'))    
    .pipe(gulp.dest('assets/javascripts'));
});

/**
 *@Description Compiler will be build scss code to css
 *
 */

gulp.task('gulpSass', function() {
    gulp.src(['assets/scss/**/*.scss', 'assets/scss/*.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCSS())
        .pipe(gulp.dest('assets/'));
});

/**
 * @Description Copy requirement resource
 * In this session system will be copy all resources file like bootstrap, etc.. to your theme
 */
gulp.task('cp_jquery', function(){
    return gulp.src(['bower_components/jquery/dist/jquery.min.js'])
    .pipe(gulp.dest('assets/javascripts'));
});

gulp.task('cp_bootstrap', function(){
    return gulp.src(['bower_components/bootstrap-sass/assets/stylesheets/**'])
    .pipe(gulp.dest('assets/stylesheets'));
});

gulp.task('cp_boostrap_js', function(){
    return gulp.src(['bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js'])
    .pipe(gulp.dest('assets/javascripts'));
});

gulp.task('cp_bootstrap_fonts', function(){
    return gulp.src(['bower_components/bootstrap-sass/assets/fonts/**'])
    .pipe(gulp.dest('assets/fonts'));
});


/**
 * @Description This session will be copy all theme file to dist folder
 */

//Clean
gulp.task('clean', function(){
    return gulp.src('dist/*', {read: false})
        .pipe(clean());
});

//styles
gulp.task('copyStyles', function(){
    return gulp.src(['assets/css/style.css'])
    .pipe(gulp.dest('dist/assets/css'));
});

//Javascript
gulp.task('copyScripts', function(){
    return gulp.src(['assets/javascripts/app.min.js'])
    .pipe(uglify())
    .pipe(gulp.dest('dist/assets/js'));
});

//Fonts
gulp.task('copyFonts', function(){
    return gulp.src(['assets/fonts/*', 'assets/fonts/**/*'])
    .pipe(gulp.dest('dist/assets/fonts'));
});

//Minifier images
gulp.task('imagemin', function () {
    return gulp.src('assets/images/*')
        .pipe(imagemin({
            progressive: true,
            use: [pngquant()]
        }))
        .pipe(gulp.dest('dist/assets/images'));
});

//Theme
gulp.task('copyTheme', function(){
    return gulp.src(['*.php', '**/*.php'])
    .pipe(gulp.dest('dist'));
});

/**************************END BUILD****************************/

// Default Task
gulp.task('default', ['gulpSass', 'concat', 'watch']);

//Gulp install resource
gulp.task('install', ['cp_jquery', 'cp_bootstrap', 'cp_boostrap_js', 'cp_bootstrap_fonts']);

/**
 * @Description Implement task synchronized
 *
 * After clean all file in dist folder, other task will be run.
 */
gulp.task('build',['clean'], function(){
    gulp.start(['copyFonts','copyStyles', 'copyScripts', 'imagemin', 'copyTheme']);
});