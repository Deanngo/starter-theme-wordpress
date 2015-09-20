module.exports = function (grunt) {
//config grunt
    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);
    grunt.initConfig({
        copy: {
            main: {
                files: [
                    {
                        // Vendor scripts.
                        expand: true,
                        cwd: 'bower_components/bootstrap-sass/assets/javascripts/',
                        src: ['**/*.js'],
                        dest: 'assets/javascripts/bootstrap/'
                    },
                    {
                        expand: true,
                        cwd: 'bower_components/jquery/dist/',
                        src: ['**/*.js', '**/*.map'],
                        dest: 'assets/javascripts/jquery/'
                    },
                     {
                        expand: true,
                        filter: 'isFile',
                        flatten: true,
                        cwd: 'bower_components/',
                        src: ['bootstrap-sass/assets/fonts/**'],
                        dest: 'assets/css/fonts/'
                    },
                     {
                        expand: true,
                        cwd: 'bower_components/bootstrap-sass/assets/stylesheets/',
                        src: ['**/*.scss'],
                        dest: 'assets/scss/'
                    }
                ]
            }
        }
        , sass: {
            options: {
                includePaths: ['bower_components/bootstrap-sass/assets/stylesheets']
            },
            dist: {
                options: {
                    outputStyle: 'css'
                },
                files: {
                    'assets/css/app.css': 'assets/scss/app.scss'
                }
            }
        }
    });
// Load task configurations
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
// Default Tasks
    grunt.registerTask('build', ['copy', 'sass']);
    grunt.registerTask('default', ['build']);
};