/*global module:false*/
module.exports = function (grunt) {

	grunt.initConfig({

		// Tasks, die mit 'grunt watch' ausgeführt werden sollen
		watch:{
			files:['Resources/Private/CoffeeScript/*.coffee', '<%= compass.prod.src %>'],
			tasks:['compass', 'coffee']
		},

		compass:{
			prod:{
				src:'Resources/Private/Sass',
				dest:'Resources/Public/Css',
				linecomments:false,
				outputstyle:'compressed',
				forcecompile:true,
				debugsass:false,
				relativeassets:true
			}
		},
		coffee: {
			compile: {
				files: {
					'Resources/Public/JavaScript/SubTabs.js': ['Resources/Private/CoffeeScript/*.coffee']
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-compass');
	grunt.loadNpmTasks('grunt-contrib-coffee');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default', ['coffee', 'compass']);
};