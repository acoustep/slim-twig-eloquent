var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var coffee = require('gulp-coffee');
var gutil = require('gulp-util');
var sass = require('gulp-ruby-sass');
var path = require('path');
var less = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('coffeescript', function() {
  gulp.src('app/assets/coffeescripts/**/*.coffee')
  .pipe(coffee({bare: true}).on('error', gutil.log))
  .pipe(gulp.dest('app/assets/javascripts'))
  .pipe(concat('application.js'))
  .pipe(uglify())
  .pipe(gulp.dest('public/js'));
})

gulp.task('javascript', function () {
    return gulp.src([
      'app/assets/javascripts/**/*.js'
    ]) //select all javascript files under js/ and any subdirectory
    .pipe(concat('application.js')) //the name of the resulting file
    .pipe(uglify())
    .pipe(gulp.dest('public/js')); //the destination folder
});

gulp.task('sass', function() {
    return sass('app/assets/sass', { sourcemap: true })
    .on('error', function (err) {
      console.error('Error', err.message);
   })
    .pipe(sourcemaps.write('maps', {
        includeContent: false,
        sourceRoot: '/source'
    }))
    .pipe(gulp.dest('public/css'));
});

gulp.task('less', function () {
  gulp.src('app/assets/less/**/*.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('public/css'));
});

gulp.task('watch', function() {
  // For Javascript
  gulp.watch(['app/assets/javascripts/**/*.js'], ['javascript']);
  // For SASS
  gulp.watch(['app/assets/sass/**/*.scss'], ['sass']);
  // For LESS
  gulp.watch(['app/assets/less/**/*.less'], ['less']);
});

gulp.task('watchCoffee', function() {
  // For Coffeescript
  gulp.watch(['app/assets/coffeescripts/**/*.coffee'], ['coffeescript']);
  // For SASS
  gulp.watch(['app/assets/sass/**/*.scss'], ['sass']);
  // For LESS
  gulp.watch(['app/assets/less/**/*.less'], ['less']);
});

gulp.task('default', ['javascript', 'less', 'sass', 'watch']);
gulp.task('coffee', ['coffeescript', 'javascript', 'less', 'sass', 'watchCoffee']);
