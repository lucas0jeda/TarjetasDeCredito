const gulp = require("gulp");
const sass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const del = require("del");
const cssmin = require("gulp-cssnano");

const sassOptions = {
  outputStyle: "expanded",
};

gulp.task("styles", () => {
  return gulp
    .src("sass/layout.scss")
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on("error", sass.logError))
    .pipe(gulp.dest("./css/"))
    .pipe(
      cssmin({
        specialComments: "all",
        minifyFontValues: { removeQuotes: false },
      })
    )
    .pipe(sourcemaps.write(""))
    .pipe(gulp.dest("./css/"));
});

gulp.task("clean", () => {
  return del(["css/layout.css"]);
});

gulp.task("default", gulp.series(["clean", "styles"]));

gulp.task("watch", () => {
  gulp.watch("sass/**/*.scss", (done) => {
    gulp.series(["clean", "styles"])(done);
  });
});
