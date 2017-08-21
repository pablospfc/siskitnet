//$ npm install --global gulp
var gulp = require('gulp');

//$ npm install -D gulp gulp-concat
var concat = require('gulp-concat');

//$ npm install -D gulp-uglify
var uglify = require('gulp-uglify');

//$ npm install -D gulp-ng-annotate
var ngAnnotate = require('gulp-ng-annotate');

//Juntar e Compilar o JS
gulp.task('js', function () {
    gulp.src(['app/src/**/*.js'])
        .pipe(concat('siskitnet.min.js'))
        .pipe(ngAnnotate())
        //.pipe(uglify())
        .pipe(gulp.dest('app/'));
});

//$ java -jar compiler.jar --js js/app.all.js --compilation_level SIMPLE_OPTIMIZATIONS --js_output_file js/app.min.js