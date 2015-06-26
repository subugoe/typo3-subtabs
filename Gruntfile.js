/*global module:false*/
module.exports = function (grunt) {

	grunt.initConfig({
		watch: {
			files: ['Resources/Private/CoffeeScript/*.coffee'],
			tasks: ['coffee']
		},
		coffee: {
			compile: {
				files: {
					'Resources/Public/JavaScript/SubTabs.js': ['Resources/Private/CoffeeScript/*.coffee']
				},
				options: {
					bare: true
				}
			}
		},
	});

	grunt.loadNpmTasks('grunt-contrib-coffee');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default', ['coffee']);
};
