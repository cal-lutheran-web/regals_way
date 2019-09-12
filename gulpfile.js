var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

// SASS


function sassCompile() {
	return gulp.src('./sass/style.scss')
		.pipe(sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(gulp.dest('.'));
}


exports.default = function () {

	sassCompile();

	gulp.watch('./sass/*.scss')
		.on('change', function (file) {
			sassCompile(file);
		})
}