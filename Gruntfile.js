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
                options: {
                    require: ['susy', 'illusion']
                },
                files: {
                    'application/site/public/theme/mobile/css/default.css': 'application/site/public/theme/mobile/css/default.scss',
                    'application/site/public/theme/mobile/css/ie.css': 'application/site/public/theme/mobile/css/ie.scss',
                    'application/site/public/theme/mobile/css/ie7.css': 'application/site/public/theme/mobile/css/ie7.scss'
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
                tasks: ['webfont'],
                options: {
                    interrupt: false,
                    atBegin: false
                }
            },
            livereload: {
                // Here we watch the files the sass task will compile to
                // These files are sent to the live reload server after sass compiles to them
                options: {
                    livereload: true
                },
                files: ['application/site/public/theme/mobile/css/default.css']
            }
        }
    });

    grunt.registerTask('default', ['watch']);
};
