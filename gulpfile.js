import gulp from "gulp";
const { src, series, dest } = gulp;
import zip from "gulp-zip";
import cleanCSS from "gulp-clean-css";
import terser from "gulp-terser";
import { deleteAsync as del } from "del";

// Define paths
const paths = {
  css: "assets/css/**/*.css",
  js: "assets/js/**/*.js",
  fonts: "vendor/mpdf/mpdf/ttfonts/**/*",
};

// Minify CSS
async function minifyCSS() {
  return src(paths.css).pipe(cleanCSS()).pipe(dest("assets/css"));
}

// Minify JS
async function minifyJS() {
  return src(paths.js).pipe(terser()).pipe(dest("assets/js"));
}

// Remove unused fonts from MPDF
async function cleanFonts() {
  return del([
    paths.fonts,
    "!vendor/mpdf/mpdf/ttfonts/*DejaVu*",
    "!vendor/mpdf/mpdf/ttfonts/*FontAwesome*",
  ]);
}

// Package Plugin
// Package Plugin
async function zipFiles() {
  return src(
    [
      "**/*",
      "!gulpfile.js",
      "!package.json",
      "!package-lock.json",
      "!node_modules/**",
      "!composer.json",
      "!composer.lock",
      "!README.md",
    ],
    { base: "." }
  )
    .pipe(zip("fa-easypdf.zip"))
    .pipe(dest("."));
}

// Define default task
export default series(minifyCSS, minifyJS, cleanFonts, zipFiles);
