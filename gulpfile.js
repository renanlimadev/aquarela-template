'use strict';

const gulp = require("gulp");
const sass = require("gulp-sass");

//Necessário para o funcionamento do gulp-sass
sass.compiler = require("node-sass");

//Inicia o comando padrão
gulp.task('default', watch);

//Inicia comando de compilação do Sass
gulp.task("sass", compilandoSass);

//Função para compilar e minificar o Sass
function compilandoSass()
{
	return gulp
	.src("sass/**/*.scss")
	.pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
	.pipe(gulp.dest("assets/css"));
}

//Função que assiste as mudanças de código
function watch()
{
	gulp.watch("src/sass/**/*.scss", compilandoSass);
}