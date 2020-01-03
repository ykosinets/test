// import gulp
import browserify from 'gulp-browserify';
import {src, parallel, dest, series, watch} from 'gulp';
import sass from 'gulp-sass';
import nodeSass from 'node-sass';
import imagemin from 'gulp-imagemin';
import gutil from 'gulp-util';
import browser from 'browser-sync';
import sourcemaps from 'gulp-sourcemaps';
sass.compiler = nodeSass;

const PATH = {
	src: './src',
	dest: './build'
};

browser
	.create()
	.init({
		serveStatic: [PATH.dest],
		port: 8080,
		proxy: {
			target: !gutil.env.production ? 'http://ykosinets.xyz/test-rony/frontend/web/' : false
		}
	});

function images() {
	return src(PATH.src + '/images/**')
		.pipe(imagemin())
		.pipe(dest(PATH.dest + '/images'));
}

function css() {
	return src(PATH.src + '/scss/app.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(dest(PATH.dest))
		.pipe(browser.reload({ stream: true }));
}

function js() {
	return src(PATH.src + '/js/app.js')
		.pipe(sourcemaps.init())
		.pipe(browserify({
			insertGlobals: true,
			debug: !gutil.env.production
		}))
		.pipe(sourcemaps.write())
		.pipe(dest(PATH.dest));
}

const watcher = function () {
	watch([PATH.src + '/js/**/*.js'])
		.on('all', series(js, browser.reload));
	watch([PATH.src + '/scss/**/*.scss'])
		.on('all', series(css, browser.reload));
	watch([PATH.src + '/images/**/*'])
		.on('all', series(images, browser.reload));
};

exports.default = series(parallel(series(css, js), watcher, images), browser.reload);
//todo browserSync proxy fix
