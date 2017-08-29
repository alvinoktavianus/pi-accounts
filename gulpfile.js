var gulp = require('gulp');
var less = require('gulp-less');
var browserSync = require('browser-sync').create();
var header = require('gulp-header');
var cleanCSS = require('gulp-clean-css');
var rename = require("gulp-rename");
var uglify = require('gulp-uglify');
var pkg = require('./package.json');
var concat = require('gulp-concat');
var mainBowerFiles = require('main-bower-files');

// Set the banner content
var banner = ['/*!\n',
    ' * Start Bootstrap - <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
    ' * Copyright 2013-' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
    ' * Licensed under <%= pkg.license.type %> (<%= pkg.license.url %>)\n',
    ' */\n',
    ''
].join('');

// Compile LESS files from /less into /css
gulp.task('less', function() {
    return gulp.src('src/less/sb-admin-2.less')
        .pipe(less())
        .pipe(header(banner, { pkg: pkg }))
        .pipe(gulp.dest('assets/css'))
        .pipe(browserSync.reload({
            stream: true
        }))
});

gulp.task('compileApplicationStyles', function () {
    return gulp.src(['src/css/*.css'])
        .pipe(concat("application.css"))
        .pipe(gulp.dest("assets/css"));
});

gulp.task('minifyApplicationStyles', ['compileApplicationStyles'], function () {
    return gulp.src(['assets/css/application.css'])
        .pipe(cleanCSS())
        .pipe(rename('application.min.css'))
        .pipe(gulp.dest("assets/css"));
});

// Minify compiled CSS
gulp.task('minify-css', ['less'], function() {
    return gulp.src('assets/css/sb-admin-2.css')
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('assets/css'))
        .pipe(browserSync.reload({
            stream: true
        }))
});

// Copy JS to dist
gulp.task('js', function() {
    return gulp.src(['src/js/*.js'])
        .pipe(concat('application.js'))
        .pipe(header(banner, { pkg: pkg }))
        .pipe(gulp.dest('assets/js'))
        .pipe(browserSync.reload({
            stream: true
        }))
})

// Minify JS
gulp.task('minify-js', ['js'], function() {
    return gulp.src('assets/js/application.js')
        .pipe(uglify())
        .pipe(header(banner, { pkg: pkg }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('assets/js'))
        .pipe(browserSync.reload({
            stream: true
        }))
});

// Copy vendor libraries from /bower_components into /assets/vendor
gulp.task('copy', function() {

    gulp.src(mainBowerFiles({ filter: '**/*.js' }))
        .pipe(concat("vendor.js"))
        .pipe(gulp.dest("assets/js"));

    gulp.src(mainBowerFiles({ filter: '**/*.css' }))
        .pipe(concat("vendor-css.css"))
        .pipe(gulp.dest("assets/css"));

    gulp.src([
            'bower_components/bootstrap/less/bootstrap.less',
            'bower_components/font-awesome/less/font-awesome.less',
        ])
        .pipe(less())
        .pipe(concat("vendor-less.css"))
        .pipe(gulp.dest("assets/css"));

    gulp.src([
            'bower_components/bootstrap/fonts/glyphicons-halflings-regular.*',
            'bower_components/font-awesome/fonts/fontawesome-webfont.*'
        ])
        .pipe(gulp.dest('assets/fonts/'));

});

gulp.task('minVendorStyles', function() {
    return gulp.src(['assets/css/vendor-*.css'])
        .pipe(cleanCSS())
        .pipe(rename('vendor.min.css'))
        .pipe(gulp.dest("assets/css"))
        .pipe(browserSync.reload({
            stream: true
        }));
});

gulp.task('minVendorScript', function() {
    return gulp.src("assets/js/vendor.js")
        .pipe(uglify())
        .pipe(rename('vendor.min.js'))
        .pipe(gulp.dest("assets/js"))
        .pipe(browserSync.reload({
            stream: true
        }));
});

// Run everything
gulp.task('default', ['minifyApplicationStyles', 'minify-css', 'minify-js', 'copy', 'minVendorStyles', 'minVendorScript']);

// Configure the browserSync task
gulp.task('browserSync', function() {
    browserSync.init({
        server: {
            baseDir: ''
        },
    })
})

// Dev task with browserSync
gulp.task('dev', ['browserSync', 'less', 'minify-css', 'js', 'minify-js'], function() {
    gulp.watch('less/*.less', ['less']);
    gulp.watch('dist/css/*.css', ['minify-css']);
    gulp.watch('js/*.js', ['minify-js']);
    // Reloads the browser whenever HTML or JS files change
    gulp.watch('pages/*.html', browserSync.reload);
    gulp.watch('dist/js/*.js', browserSync.reload);
});
