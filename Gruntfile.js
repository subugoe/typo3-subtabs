/*global module:false*/
module.exports = function (grunt) {

	grunt.initConfig({

		// Tasks, die mit 'grunt watch' ausgeführt werden sollen
		watch: {
			files: ['Resources/Private/CoffeeScript/*.coffee', '<%= compass.prod.src %>'],
			tasks: ['compass', 'coffee']
		},

		compass: {
			prod: {
				src: 'Resources/Private/Sass',
				dest: 'Resources/Private/Css',
				linecomments: false,
				forcecompile: true,
				debugsass: false,
				relativeassets: true
			}
		},
		coffee: {
			compile: {
				files: {
					'Resources/Public/JavaScript/SubTabs.js': ['Resources/Private/CoffeeScript/*.coffee']
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions', '> 5%']
			},
			single_file: {
				src: '<%= compass.prod.dest %>/Tabs.css',
				dest: 'Resources/Public/Css/Tabs.css'
			}
		}

	});

	grunt.loadNpmTasks('grunt-compass');
	grunt.loadNpmTasks('grunt-contrib-coffee');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.registerTask('default', ['coffee', 'compass', 'autoprefixer']);
};