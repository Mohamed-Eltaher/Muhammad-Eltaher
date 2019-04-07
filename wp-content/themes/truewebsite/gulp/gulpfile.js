var gulp = require('gulp'),

	sass = require('gulp-sass'),

    concat = require('gulp-concat'),

    prefix = require('gulp-autoprefixer'),

    uglify = require('gulp-uglify'),

    glob = require("glob"),

    livereload = require('gulp-livereload');

   

// Html
gulp.task('html', function() {
  gulp.src('../**/*.php')
    .pipe(livereload());
});

// Sass files
gulp.task('sass', function() {

	return gulp.src('../sass/main.scss')
	.pipe(sass({errLogToConsole: true}))
	.pipe(concat('main.css'))
	.pipe(prefix('last 2 versions'))
	.pipe(gulp.dest('../sass'))
	.pipe(livereload())

})


// Watch Files
gulp.task('watch', function() {
	require('./server.js');
	livereload.listen();
	gulp.watch("../sass/**/*.scss", ['sass']);
	gulp.watch("../**/*.php", ['html']);
		
})

// default task
gulp.task('default', ['watch']);
