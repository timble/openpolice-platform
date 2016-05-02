module.exports = function(grunt) {

    // load time-grunt and all grunt plugins found in the package.json
    require( 'load-grunt-tasks' )( grunt );

    grunt.initConfig({

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
            }
        }
    });

    grunt.registerTask('default', ['browserSync', 'watch']);
};
