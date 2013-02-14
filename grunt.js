/*global module:false*/
module.exports = function (grunt) {

	grunt.initConfig({

						// Liste der Dateien, deren Syntax mit JSHint geprüft werden soll
						lint:{files:['grunt.js', 'Resources/Public/Js/*.js'] },

						// Liste der Dateien, die zusammengefasst werden sollen (Quell- und Zieldateien)
						concat:{
							js:{
								src:['Resources/Private/JavaScripts/TabClick.js', 'Resources/Private/JavaScripts/Tabs.js', 'Resources/Private/JavaScripts/Suggest.js'],
								dest:'Resources/Private/JavaScripts/SubTabs.js'
							}
						},

						// Liste der Dateien, die minifiziert werden sollen (Quell- und Zieldateien)
						min:{
							dist:{
								src:['<config:concat.js.dest>'],
								dest:'Resources/Public/JavaScript/SubTabs.min.js'
							}},

						// Tasks, die mit 'grunt watch' ausgeführt werden sollen
						watch:{
							files:['<config:lint.files>', '<config:coffee.app.src>'],
							tasks:'compass coffee lint concat min'},

						uglify:{},
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
						coffee:{
							app: {
								src: ['Resources/Private/CoffeeScript/*.coffee'],
								dest: 'Resources/Private/JavaScripts',
								options: {
									bare: true
								}
							}
						}
					});

	// Default task, der ausgeführt wird, wenn man Grunt ohne weitere Parameter aufruft.
	grunt.registerTask('default', 'coffee compass lint concat min');
	grunt.loadNpmTasks('grunt-compass');
	grunt.loadNpmTasks('grunt-coffee');
};