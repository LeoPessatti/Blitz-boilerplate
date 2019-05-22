"use strict";

// Carregar os plugins
const autoprefixer = require("autoprefixer");
const cp = require("child_process");
const cssnano = require("cssnano");
const eslint = require("gulp-eslint");
const gulp = require("gulp");
const imagemin = require("gulp-imagemin");
const newer = require("gulp-newer");
const postcss = require("gulp-postcss");
const sass = require("gulp-sass");
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

// Otimizar imagens
function images() {
	return gulp
		.src("app/views/assets/img/**/*")
		.pipe(newer("app/views/assets/img"))
		.pipe(
			imagemin([
				imagemin.gifsicle({
					interlaced: true
				}),
				imagemin.jpegtran({
					progressive: true
				}),
				imagemin.optipng({
					optimizationLevel: 5
				}),
				imagemin.svgo({
					plugins: [{
						removeViewBox: false,
						collapseGroups: true
					}]
				})
			])
		)
		.pipe(gulp.dest("app/views/assets/img"));
}

// Compilar o SASS em CSS, concatenar em um único arquivo e minificar
function css() {
	return gulp
		.src("app/views/assets/css/scss/**/*.scss")
		.pipe(concat('style.min.css'))
		.pipe(sass({
			outputStyle: "expanded"
		}))
		.pipe(postcss([autoprefixer(), cssnano()]))
		.pipe(gulp.dest("app/views/assets/css/"));
}

// Lint dos scripts
function scriptsLint() {
	return gulp
		.src(["app/views/assets/js/**/*", "./gulpfile.js"])
		.pipe(eslint({
			configFile: 'eslint.json'
		}))
		.pipe(eslint.format())
		.pipe(eslint.failAfterError());
}

// Transpilar, concatenar e minificar os scripts
function scripts() {
	return (
		gulp
		.src(["app/views/assets/js/functions/*"])
		.pipe(concat('functions.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest("app/views/assets/js/"))

	);
}

// Jekyll
function jekyll() {
	return cp.spawn("bundle", ["exec", "jekyll", "build"], {
		stdio: "inherit"
	});
}


// Esperar por alterações
function watchFiles() {
	gulp.watch("app/views/assets/css/scss/**/*.scss", css);
	gulp.watch("app/views/assets/img/**/*", images);
	gulp.watch("app/views/assets/js/functions/*.js", gulp.series(scripts, scriptsLint));
}

// Define tarefas mais complexas
const js = gulp.series(scripts, scriptsLint);
const build = gulp.series(gulp.parallel(css, images, jekyll, js));
const watch = gulp.parallel(watchFiles);

// exports
exports.images = images;
exports.css = css;
exports.js = js;
exports.jekyll = jekyll;
exports.build = build;
exports.watch = watch;
exports.default = build;