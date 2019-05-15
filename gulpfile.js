require('es6-promise').polyfill();
var gulp = require('gulp');
var cleanCss = require('gulp-clean-css');
var concatCss = require('gulp-concat');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var concatJs = require('gulp-concat');
var uglify = require('gulp-uglify');
var browserSync = require('browser-sync');

// forma os numeros
function pad(num) {
	var s = num + '';
	return (s.length <= 1) ? '0' + s : s;
}

// processa o scss
gulp.task('sass', function () {
	return gulp.src('app/app/views/assets/css/scss/style.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('app/views/assets/css/'));
});

// concatena os css
gulp.task('concatcss', function () {
	return gulp.src(['app/views/assets/css/default.css', 'app/views/assets/css/libs/*.css', 'app/views/assets/css/estilo.css'])
		.pipe(concatCss('style.css', {
			inlineImports: false,
			rebaseUrls: false
		}))
		.pipe(gulp.dest('./app/views/assets/css'));
});

// minifica o css e salva na raiz
gulp.task('styles', function () {
	var date = new Date();

	return gulp.src('app/views/assets/css/style.css')
		.pipe(cleanCss({
			compatibility: ''
		}))
		.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(rename('style.css'))
		.pipe(gulp.dest('./'))
		.pipe(notify({
			message: "Styles updated! @ <%= options.date %>",
			templateOptions: {
				date: pad(date.getHours()) + ':' + pad(date.getMinutes()) + ':' + pad(date.getSeconds())
			}
		}))
		.pipe(browserSync.stream({
			once: true
		}));
});

// concatena o js
gulp.task('concatjs', function () {
	return gulp.src(['app/views/assets/js/libs/dependencies/*.js', 'app/views/assets/js/libs/*.js', 'app/views/assets/js/funcoes/**/*.js'])
		.pipe(concatJs('funcoes.js'))
		.pipe(gulp.dest('app/views/assets/js/'));
});

// minifica o js e salva
gulp.task('uglify', function () {
	var date = new Date();

	return gulp.src('app/views/assets/js/funcoes.js')
		.pipe(uglify({
			mangle: false
		}))
		.pipe(rename('funcoes.min.js'))
		.pipe(gulp.dest('./app/views/assets/js'))
		.pipe(notify({
			message: "Scripts updated! @ <%= options.date %>",
			templateOptions: {
				date: pad(date.getHours()) + ':' + pad(date.getMinutes()) + ':' + pad(date.getSeconds())
			}
		}))
		.pipe(browserSync.stream({
			once: true
		}));
});

// assiste os .php e avisa o bsync
gulp.task('php', function () {
	gulp.watch("**/*.php").on('change', function () {
		var date = new Date();

		notify({
			message: "PHP updated! @ <%= options.date %>",
			templateOptions: {
				date: pad(date.getHours()) + ':' + pad(date.getMinutes()) + ':' + pad(date.getSeconds())
			}
		});
		browserSync.reload();
	});
});

// assiste e executa as tarefas
gulp.task('watch', ['build'], function () {
	gulp.watch(['app/views/assets/css/scss/**/*.scss'], ['sass']);
	gulp.watch(['app/views/assets/css/estilo.css', 'app/views/assets/css/libs/**/*.css'], ['concatcss']);
	gulp.watch(['app/views/assets/css/style.css'], ['styles']);
	gulp.watch(['app/views/assets/js/libs/**/*.js', 'app/views/assets/js/funcoes/*.js'], ['concatjs']);
	gulp.watch('app/views/assets/js/funcoes.js', ['uglify']);
});

// bsync
gulp.task('serve', ['php', 'watch'], function () {
	browserSync.init({
		proxy: "http://192.168.0.2/" // url do seu projeto
	});
});

// tarefa padrao
gulp.task('default', ['watch']);

// gera todos os arquivos necesários
gulp.task('build', ['sass', 'concatcss', 'styles', 'concatjs', 'uglify']);