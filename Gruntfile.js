module.exports = function(grunt) {

    // load time-grunt and all grunt plugins found in the package.json
    require( 'load-grunt-tasks' )( grunt );

    grunt.initConfig({

        // Copy bower files
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        src: ['bower_components/select2/*.*'],
                        dest: 'application/site/public/theme/muhimu/components/select2',
                        flatten: true
                    },
                ]
            },
        },

        // Sass
        sass: {
            dist: {
                files: {
                    'application/site/public/theme/muhimu/css/default.css': 'application/site/public/theme/muhimu/css/default.scss',
                    'application/site/public/theme/muhimu/css/fonts.css': 'application/site/public/theme/muhimu/css/fonts.scss',
                    'application/site/public/theme/muhimu/css/ie.css': 'application/site/public/theme/muhimu/css/ie.scss'
                }
            }
        },

        // Autoprefixer
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 10']
            },
            files: {
                expand: true,
                flatten: true,
                src: 'application/site/public/theme/muhimu/css/*.css',
                dest: 'application/site/public/theme/muhimu/css/'
            }
        },

        // Uglify
        uglify: {
            options: {
                soureMap: true
            },
            build: {
                files: {
                    'application/site/public/theme/muhimu/js/jquery.js': [
                        'bower_components/jquery/dist/jquery.min.js'
                    ]
                }
            }
        },

        // CSSmin
        cssmin: {
            options: {
                roundingPrecision: -1,
                level: 2
            },
            site: {
                files: {
                    'application/site/public/theme/muhimu/css/default.css': 'application/site/public/theme/muhimu/css/default.css'
                }
            }
        },

        browserSync: {
            dev: {
                bsFiles: {
                    src : 'application/site/public/theme/muhimu/css/default.css'
                },
                options: {
                    proxy: "police.dev",
                    port: 7654, // POLI on phone keypad
                    watchTask: true, // < VERY important
                    notify: false
                }
            }
        },

        // Watch
        watch: {
            css: {
                files: '**/*.scss',
                tasks: ['sass', 'cssmin', 'autoprefixer'],
                options: {
                    interrupt: false,
                    atBegin: true
                }
            },
            uglify: {
                files: [
                    // 'application/site/public/theme/wepo/js/*.js'
                ],
                tasks: ['uglify'],
                options: {
                    interrupt: false,
                    atBegin: true
                }
            }
        }
    });

    grunt.registerTask('default', ['uglify', 'copy', 'browserSync', 'watch']);
};
