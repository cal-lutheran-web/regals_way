const gulp = require("gulp");
const sass = require("gulp-sass");
const autoprefixer = require("gulp-autoprefixer");


// SASS


function sassCompile() {
	return gulp.src(['./sass/style.scss','./sass/editor-style.scss'])
		.pipe(sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe(autoprefixer({
			cascade: false
		}))
		.pipe(gulp.dest('.'));
}


exports.default = function () {

	sassCompile();

	gulp.watch('./sass/*.scss')
		.on('change', function (file) {
			sassCompile(file);
		});
}