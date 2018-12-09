let gulp = require('gulp'),
    concat = require('gulp-concat');

gulp.task('welcome-css', function() {
    return gulp.src(['resources/css/welcome/**/*.css', 'resources/css/common/*.css'])
        .pipe(concat('welcome.css'))
        //.pipe(uglify())
        .pipe(gulp.dest('public/css'));
});

gulp.task('login-css', function () {
    return gulp.src(['resources/css/login/**/*.css', 'resources/css/common/*.css'])
        .pipe(concat('login.css'))
        //.pipe(uglify())
        .pipe(gulp.dest('public/css'));
});