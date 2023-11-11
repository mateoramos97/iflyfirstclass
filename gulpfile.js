var gulp = require('gulp');
// var sass = require('gulp-sass');
const sass = require('gulp-sass')(require('sass'));
var minifyCss = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var clean = require('gulp-clean');
var spritesmith = require('gulp.spritesmith');
var concat = require('gulp-concat');
var uglify = require('gulp-uglifyjs');

var F_webDir = 'frontend/web/';

var F_sourseDir = F_webDir + 'source/',
    F_sassDir = F_sourseDir + 'sass/',
    F_sassMainFile = F_sassDir + 'main.scss',
    F_jsDir = F_sourseDir + 'js/',
    F_jsCustomFile = F_jsDir + 'custom.js';

var F_destDir = F_webDir + 'dist/';

var F_destCssDir = F_destDir + 'css/',
    F_destCssMinDir = F_destDir + 'css-min/';

var F_destJsDir = F_destDir + 'js/',
    F_destJsMinDir = F_destDir + 'js-min/';

var sassOptions = {
    outputStyle: 'expanded',
    precison: 3,
    errLogToConsole: true
};

gulp.task('front:compileSass', function(){
    return gulp
        .src([F_sassMainFile])
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(gulp.dest(F_destCssDir))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifyCss({processImport: false}))
        .pipe(gulp.dest(F_destCssMinDir));
});

gulp.task('front:scripts', function() {
    return gulp.src([F_jsCustomFile])
        .pipe(concat('custom.js'))
        .pipe(gulp.dest(F_destJsDir))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest(F_destJsMinDir));
});

gulp.task('front:clean', function() {
    return gulp.src([F_destCssDir, F_destCssMinDir, F_destJsDir, F_destJsMinDir], {read: false})
        .pipe(clean());
});

gulp.task('sprite', function () {
    var spriteData = gulp.src(F_webDir + 'img-styles/icons48X48/*.png').pipe(spritesmith({
        imgName: 'sprite-icons48X48.png',
        cssName: 'sprite-icons48X48.scss'
    }));
    return spriteData.pipe(gulp.dest(F_webDir + 'img-styles/sprite-icons48X48/'));
});

// gulp.task('watch', function(){
//     gulp.watch(F_sassDir + '**/*.scss', [
//         'front:compileSass'
//     ]);
//     gulp.watch(F_jsCustomFile, [
//         'front:scripts'
//     ]);
// });

gulp.task('watch', function() {
    gulp.watch(F_sassDir + '**/*.scss', gulp.series('front:compileSass'));
    gulp.watch(F_jsCustomFile, gulp.series('front:scripts'));
})
