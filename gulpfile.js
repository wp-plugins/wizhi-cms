var gulp = require('gulp');
 
// 引入组件
var less = require('gulp-less'),            // less
    minifycss = require('gulp-minify-css'), // CSS压缩
    uglify = require('gulp-uglify'),        // js压缩
    concat = require('gulp-concat'),        // 合并文件
    rename = require('gulp-rename'),        // 重命名
    clean = require('gulp-clean');          //清空文件夹
 
// less解析
gulp.task('less', function(){
  gulp.src('./assets/less/**/*.less')
    .pipe(less())
    .pipe(gulp.dest('./assets/css/'))
});

// 清空图片、样式、js
gulp.task('clean', function() {
  return gulp.src(['./assets/css/zui.css','./assets/css/zui.min.css'], {read: false})
    .pipe(clean({force: true}));
});
 
// 合并、压缩、重命名css
gulp.task('css',['less', 'clean'], function() {
    // 注意这里通过数组的方式写入两个地址,仔细看第一个地址是css目录下的全部css文件,第二个地址是css目录下的areaMap.css文件,但是它前面加了!,这个和.gitignore的写法类似,就是排除掉这个文件.
  gulp.src(['./assets/css/*.css','!./assets/css/zui.min.css'])
    .pipe(concat('zui.css'))
    .pipe(gulp.dest('./assets'))
    //.pipe(minifycss())
    //.pipe(gulp.dest('./'))
});
 
// 合并，压缩js文件
gulp.task('js', function() {
  gulp.src('./assets/js/*.js')
    .pipe(concat('script.js'))
    .pipe(gulp.dest('./assets'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('./assets'));
});
 
// 将bower的库文件对应到指定位置
gulp.task('build',function(){
 
});
 
// 定义develop任务在日常开发中使用
gulp.task('dev',function(){
  gulp.run('build','less','js','css');
 
  gulp.watch('./javis/static/less/**/*.less', ['less', 'css']);
});
 
// 定义一个prod任务作为发布或者运行时使用
gulp.task('prod',function(){
  gulp.run('build','less','css','js');
 
  // 监听.less文件,一旦有变化,立刻调用build-less任务执行
  gulp.watch('./assets/less/**/*.less', ['less', 'css']);
});
 
// gulp命令默认启动的就是default认为,这里将clean任务作为依赖,也就是先执行一次clean任务,流程再继续.
gulp.task('default',['clean'], function() {
  gulp.run('dev');
});