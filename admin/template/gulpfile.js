// including plugins
var gulp = require('gulp')
, uglify = require("gulp-uglify")
, rename = require("gulp-rename");


 
// task
gulp.task('default', function () {
    gulp.src('./js/ecss.js') // path to your files
    .pipe(uglify()) // minify files
    .pipe(rename('ecss.min.js')) // rename files
    .pipe(gulp.dest('./js'));
});

 
// task
gulp.task('watch', function () {
    gulp.watch(['./js/ecss.js'], ['default']);
});