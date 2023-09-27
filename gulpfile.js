const gulp = require("gulp");
const zip = require("gulp-zip");
const cleanCSS = require("gulp-clean-css");
const terser = require("gulp-terser");
const imagemin = require("gulp-imagemin");

// Define paths
const paths = {
  css: "assets/css/**/*.css",
  js: "assets/js/**/*.js",
  images: "assets/images/**/*",
  php: "**/*.php",
  languages: "languages/**/*",
  templates: "templates/**/*",
};

// Minify CSS
function minifyCss() {
  return gulp.src(paths.css).pipe(cleanCSS()).pipe(gulp.dest("assets/css"));
}

// Minify JS
function minifyJs() {
  return gulp.src(paths.js).pipe(terser()).pipe(gulp.dest("assets/js"));
}

// Optimize Images
function optimizeImages() {
  return gulp
    .src(paths.images)
    .pipe(imagemin())
    .pipe(gulp.dest("assets/images"));
}

// Package Plugin
function packagePlugin() {
  return gulp
    .src(
      [
        paths.php,
        paths.css,
        paths.js,
        paths.images,
        paths.languages,
        paths.templates,
      ],
      { base: "." }
    )
    .pipe(zip("fa-easy-wp-pdf.zip"))
    .pipe(gulp.dest("."));
}

// Define default task
const defaultTask = gulp.series(
  minifyCss,
  minifyJs,
  optimizeImages,
  packagePlugin
);

// Export tasks
exports.minifyCss = minifyCss;
exports.minifyJs = minifyJs;
exports.optimizeImages = optimizeImages;
exports.packagePlugin = packagePlugin;
exports.default = defaultTask;
