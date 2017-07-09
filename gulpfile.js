'use strict';

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    mainBowerFiles = require('main-bower-files'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    less = require('gulp-less'),
    cleanCSS = require('gulp-clean-css'),
    jsFiles = ['js_src/*'];

gulp.task("concatScripts", function () {
    gulp.src(mainBowerFiles({ filter: '**/*.js' }).concat(jsFiles))
        .pipe(concat("application.js"))
        .pipe(gulp.dest("assets/js"));
});

gulp.task("compileLess", function () {
    gulp.src(mainBowerFiles({ filter: '**/*.less' }))
        .pipe(less())
        .pipe(concat("application.css"))
        .pipe(gulp.dest("assets/css"));
});

gulp.task("minifyScripts", function () {
    gulp.src("assets/js/application.js")
        .pipe(uglify())
        .pipe(rename('application.min.js'))
        .pipe(gulp.dest("assets/js"));
});

gulp.task("minifyStyles", function () {
    gulp.src("assets/css/application.css")
        .pipe(cleanCSS())
        .pipe(rename('application.min.css'))
        .pipe(gulp.dest("assets/css"));
});
