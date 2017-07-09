'use strict';

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    mainBowerFiles = require('main-bower-files'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    less = require('gulp-less'),
    cleanCSS = require('gulp-clean-css'),
    jsFiles = ['src/js/*'];

gulp.task("concatVendorScripts", function () {
    gulp.src(mainBowerFiles({ filter: '**/*.js' }))
        .pipe(concat("vendor.js"))
        .pipe(gulp.dest("assets/js"));
});

gulp.task("concatApplicationScripts", function () {
    gulp.src(['src/js/*.js'])
        .pipe(concat("application.js"))
        .pipe(gulp.dest("assets/js"));
});

gulp.task("compileLess", function () {
    gulp.src(mainBowerFiles({ filter: '**/*.less' }))
        .pipe(less())
        .pipe(concat("application.css"))
        .pipe(gulp.dest("assets/css"));
});

gulp.task("minifyVendorScripts", function () {
    gulp.src("assets/js/vendor.js")
        .pipe(uglify())
        .pipe(rename('vendor.min.js'))
        .pipe(gulp.dest("assets/js"));
});

gulp.task("minifyApplicationScripts", function () {
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

// Single task
gulp.task("createDevScripts", ['concatVendorScripts', 'concatApplicationScripts']);
gulp.task("createProdScripts", ['createDevScripts', 'minifyVendorScripts', 'minifyApplicationScripts']);