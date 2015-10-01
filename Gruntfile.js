module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            src: {
                files: ['**/*.scss', '**/*.php', '**/**/*.scss', ],
                tasks: ['compass']
            },
            options: {
                livereload: true
            },
            javascripts: {
                files: "javascripts/app.js",
                tasks: ['uglify']
            }
        },

        compass: {
            dist: {
                options: {
                    sassDir: 'assets',
                    cssDir: '',
                    imagesDir: 'images',
                    javascriptsDir: 'javascripts',
                    fontsDir: 'assets/fonts',
                    outputStyle: 'compressed',
                    relativeAssets: false,
                    noLineComments: false,
                    debugInfo: false
                }
            }
        },

        uglify: {
            build: {
                files: {                     
                    'javascripts/app.min.js': ['javascripts/app.js']
                }
            },
            compress: true
        },
         
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        dest: 'assets/stylesheets',
                        src: ['**'],
                        cwd: 'bower_components/bootstrap-sass/assets/stylesheets'
                    }, {
                        expand: true,
                        dest: 'assets/fonts',
                        src: ['**'],
                        cwd: 'bower_components/bootstrap-sass/assets/fonts'
                    }, {
                        expand: true,
                        dest: 'javascripts',
                        src: ['bootstrap.min.js'],
                        cwd: 'bower_components/bootstrap-sass/assets/javascripts'
                    }, {
                        expand: true,
                        dest: 'javascripts',
                        src: ['bootstrap.js'],
                        cwd: 'bower_components/bootstrap-sass/assets/javascripts'
                    }
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');    
    grunt.registerTask('default', ['copy','compass', 'uglify']);

};
