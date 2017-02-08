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
                    'application/site/public/theme/muhimu/css/ie.css': 'application/site/public/theme/muhimu/css/ie.scss',
                    'application/site/public/theme/muhimu/css/ie7.css': 'application/site/public/theme/muhimu/css/ie7.scss'
                }
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
                tasks: ['sass'],
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
