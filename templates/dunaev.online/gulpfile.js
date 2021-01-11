'use strict'

var gulp = require('gulp'),
    watch = require('gulp-watch'),
    prefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    rigger = require('gulp-rigger'),
    cssmin = require('gulp-minify-css'),
    rimraf = require('rimraf'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    babel = require('gulp-babel')

var path = {
    build: {
        js: '../../www/js/',
        css: '../../www/css/',
        img: '../../www/img/',
        fonts: '../../www/fonts'
        // js: 'build/js/',
        // css: 'build/css/',
        // img: 'build/img/',
        // fonts: 'build/fonts/'
    },
    src: {
        js: 'src/scripts/main.js',
        style: 'src/scss/style.scss',
        img: 'src/img/**/*.*',
        fonts: 'src/fonts/**/*.*'
    },
    watch: {
        js: 'src/scripts/*.js',
        style: 'src/scss/*.scss',
        img: 'src/img/**/*.*',
        fonts: 'src/fonts/**/*.*'
    },
    clean: './build'
};

gulp.task('clean', function (cb) {
    rimraf(path.clean, cb)
});

gulp.task('js:build', async function () {
    gulp.src(path.src.js)
        .pipe(rigger())
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['@babel/env']
        }))
    .pipe(uglify())
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(path.build.js));
});

gulp.task('style:build', async function () {
    gulp.src(path.src.style)
    .pipe(sass({ outputStyle: 'expanded' }).on('error', notify.onError()))
    .pipe(sourcemaps.init())
    .pipe(sass({
        sourceMap: false,
        errLogToConsole: true
    }))
    .pipe(prefixer())
    .pipe(cssmin())
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(path.build.css));
});

gulp.task('img:build', async function () {
    gulp.src(path.src.img)
        .pipe(gulp.dest(path.build.img))
});

gulp.task('fonts:build', async function () {
    gulp.src(path.src.fonts)
        .pipe(gulp.dest(path.build.fonts))
});

gulp.task('build', gulp.parallel (
    'js:build',
    'style:build',
    'fonts:build',
    'img:build'
));

gulp.task('watch', function() {
    gulp.watch([path.watch.js],  gulp.parallel('js:build') );
    gulp.watch([path.watch.style],  gulp.parallel('style:build') );
    gulp.watch([path.watch.img],  gulp.parallel('img:build') );
    gulp.watch([path.watch.fonts],  gulp.parallel('fonts:build') );
});

gulp.task('default', gulp.series('build', 'watch'));
