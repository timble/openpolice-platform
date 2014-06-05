module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                options: {
                    require: 'susy'
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
                tasks: ['sass']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
};