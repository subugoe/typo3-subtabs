var gulp = require('gulp')
var coffee = require('gulp-coffee')
var coffeelint = require('gulp-coffeelint')
var concat = require('gulp-concat')
var notify = require('gulp-notify')

var names = {
	js: 'SubTabs.js'
}

var paths = {
	coffee: 'Resources/Private/CoffeeScript/*.coffee',
	js: 'Resources/Public/JavaScript'
}

gulp.task('coffee', function(){
	gulp.src(paths.coffee)
		.pipe(coffeelint())
		.pipe(coffeelint.reporter())
		.pipe(coffee({bare: false}).on('error', function(err){
			notify(err.stack).write(err)
		}) )
		.pipe(concat(names.js))
		.pipe(gulp.dest(paths.js))
})

gulp.task('watch', function(){
	gulp.watch(paths.coffee, ['coffee'])
})

gulp.task('default', ['coffee', 'watch'])
