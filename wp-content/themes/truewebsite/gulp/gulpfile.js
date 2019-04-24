var gulp = require('gulp'),

	sass = require('gulp-sass'),

    concat = require('gulp-concat'),

    prefix = require('gulp-autoprefixer'),

    uglify = require('gulp-uglify'),

    cleanCSS = require('gulp-clean-css'),

    htmlmin = require('gulp-htmlmin'),

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
	.pipe(concat('style.css'))
	.pipe(prefix('last 2 versions'))
	.pipe(cleanCSS())
	.pipe(gulp.dest('../'))
	.pipe(livereload())

});


gulp.task('uglify', function () {
  return gulp.src('../js/*.js')
  	.pipe(concat('bundle.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('../js/min-js'));
});


// Watch Files
gulp.task('watch', function() {
	require('./server.js');
	livereload.listen();
	gulp.watch("../sass/**/*.scss", ['sass']);
	gulp.watch("../**/*.php", ['html']);
	gulp.watch("../js/*.js", ['uglify']);
		
})

// default task
gulp.task('default', ['watch']);
