module.exports = function(grunt) {

    // load time-grunt and all grunt plugins found in the package.json
    require( 'load-grunt-tasks' )( grunt );

    grunt.initConfig({

        // Iconfont
        webfont: {
            icons: {
                src: 'application/site/public/theme/mobile/images/icons/*.svg',
                dest: 'application/site/public/theme/mobile/fonts/icons',
                destCss: 'application/site/public/theme/mobile/css/utilities',
                options: {
                    font: 'police-icons',
                    hashes: false,
                    stylesheet: 'scss',
                    relativeFontPath: '../fonts/icons/',
                    template: 'application/site/public/theme/mobile/fonts/icons/template.css',
                    htmlDemo: false
                }
            }
        },

        // Sass
        sass: {
            dist: {
                files: {
                    'application/site/public/theme/mobile/css/default.css': 'application/site/public/theme/mobile/css/default.scss',
                    'application/site/public/theme/mobile/css/grid.css': 'application/site/public/theme/mobile/css/grid.scss',
                    'application/site/public/theme/mobile/css/ie.css': 'application/site/public/theme/mobile/css/ie.scss',
                    'application/site/public/theme/mobile/css/ie9.css': 'application/site/public/theme/mobile/css/ie9.scss'
                }
            }
        },

        browserSync: {
            dev: {
                bsFiles: {
                    src : 'application/site/public/theme/mobile/css/default.css'
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
            fontcustom: {
                files: [
                    'application/site/public/theme/mobile/images/icons/*.svg'
                ],
                tasks: ['webfont', 'sass'],
                options: {
                    interrupt: true,
                    atBegin: true
                }
            }
        }
    });

    grunt.registerTask('default', ['browserSync', 'watch']);
};
