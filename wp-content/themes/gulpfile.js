var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglifyjs = require('gulp-uglify'),
    uglifycss = require('gulp-clean-css'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    paths = {
        parent: {
            path: './sogo/dist/',
            scripts: [
                './node_modules/jquery-ui-dist/jquery-ui.js',
                './node_modules/popper.js/dist/umd/popper.js',
                './node_modules/bootstrap/dist/js/bootstrap.js',
                './node_modules/slick-carousel/slick/slick.js',
            ],
            style: [
                './node_modules/jquery-ui-dist/jquery-ui.css',
                './node_modules/slick-carousel/slick/slick.css',
                './node_modules/hover.css/css/hover.css',
            ]
        },
        child: {
            path: './sogo-child/',
            src: {
                sass: './sogo-child/src/scss/**',
                js: './sogo-child/src/js/*.js',
            },
            scripts: [
                './node_modules/aos/dist/aos.js',
                './node_modules/stickybits/dist/stickybits.js',
                './node_modules/sweetalert2/dist/sweetalert2.js',
                './node_modules/jquery-validation/dist/jquery.validate.js',
                './sogo-child/src/js/*.js'
            ]
        }
    };

sass.compiler = require('node-sass');

gulp.task('parent_scripts', function () {
    return gulp.src(paths.parent.scripts)
        .pipe(concat('bundle.js'))
        .pipe(uglifyjs())
        .pipe(gulp.dest(paths.parent.path));
});

gulp.task('parent_style', function () {
    return gulp.src(paths.parent.style)
        .pipe(concat('style.css'))
        .pipe(uglifycss())
        .pipe(gulp.dest(paths.parent.path));
});


gulp.task('sass', function () {
    return gulp.src(paths.child.src.sass)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(paths.child.path));
});

gulp.task('js', function () {
    return gulp.src(paths.child.scripts)
        .pipe(concat('bundle.js'))
        .pipe(gulp.dest(paths.child.path));
});

gulp.task('watch-child', function () {
    gulp.watch(paths.child.src.sass, gulp.series('sass'));
    gulp.watch(paths.child.src.js, gulp.series('js'));
});
