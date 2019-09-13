/**
 * Dependencies
 */
var gulp        = require('gulp'),
	rename      = require('gulp-rename'),
	clean       = require('gulp-clean'),
	rev         = require('gulp-rev'),
	rev_col     = require('gulp-rev-collector'),
	htmlreplace = require('gulp-html-replace');

/* Clean old revs */
gulp.task('build:clean:rev', function() {
	return gulp
		.src(['./js/functions-*', './index.rev.php'], {read: false})
		.pipe(clean());
});

/* Build rev js */
gulp.task('build:rev:js', function() {
	return gulp
		.src(['./js/functions.js'])
		.pipe(rev())
		.pipe(gulp.dest('./js/'))
		.pipe(rev.manifest('rev.json'))
		.pipe(gulp.dest('./'));
});

/* Clone to update */
gulp.task('build:rev:php', function() {
	return gulp
		.src('index.php')
		.pipe(rename('index.rev.php'))
		.pipe(gulp.dest('./'));
});

/* Update js name */
gulp.task('build:rev:update', function() {
	return gulp
		.src(['./rev.json', './index.rev.php'])
		.pipe(rev_col())
		.pipe(gulp.dest('./'));
});

gulp.task('build:rev', gulp.series('build:clean:rev', 'build:rev:js', 'build:rev:php', 'build:rev:update'));
