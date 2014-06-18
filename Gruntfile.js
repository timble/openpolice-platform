module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
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
        watch: {
            css: {
                files: '**/*.scss',
                tasks: ['sass'],
                options: {
                    atBegin: true
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

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};