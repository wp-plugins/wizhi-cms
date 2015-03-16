=== Plugin Name ===
Contributors: Amos Lee
Donate link: 
Tags: admin, post, pages, plugin, cms
Requires at least: 3.4
Tested up to: 4.1
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wizhi CMS 以简码的形式添加了中国一些CMS系统常用的调用标签，如织梦，PHPCMS等系统中的模板标签功能。

== Description ==

Wizhi CMS 以简码的形式添加了中国一些CMS系统常用的调用标签，如织梦，PHPCMS等系统中的模板标签功能。

= CSS 栅格系统 =

基于Yahoo 的 Pure Css 0.4.2 的CSS栅格系统，可以很方便的创建各种宽度的自适应栅格，没有没完没了的宽度设置，只需要调整细节的样式就可以了。
同时也包含了一些media，list，form，button等基本样式，有兴趣的可以查看源码使用。

= 显示一个文章标题列表模块 =

`<?php echo do_shortcode('[title_list type="post" tax="category" tag="default" num="6" cut="26" heading="0" time="true"]'); ?>`

参数：

* type：自定义文章类型的别名，默认为post
* tax：自定义分类法的别名，默认为category
* tag：自定义分类法的分类项目别名，默认为default
* num：显示的文章篇数，默认为6篇
* cut：标题自动截断的字符数，默认为26
* heading：是否显示以自定义分类法分类项目作为名称的标题，含有一个“更多”的链接，如果没有设置tax或tag参数，标题不会显示
* time：是否显示文章发表的时间，默认为不现实，设置为true显示

= 显示一个图文列表模块 =

`<?php echo do_shortcode('[photo_list type="home" tax="home_tag" tag="yxdt" num="6" cut="26" heading="false" time="true" thumbs="maintain" cut="6" class="pure-u-1-5" position="left"]'); ?>`

和上面的title_list相比，增加了以下参数：

* thumbs：显示的缩略图尺寸，默认为tumbnails
* class：附加的图文列表上的CSS类，默认为“pure-u-1-4”，一列显示4个文章。
* position：图片显示的位置，不设置默认为显示在文章顶部，可选项为“left”显示在文章左侧或“right”显示在文章右侧

插件中只包含了一些基本样式，所以看起来有点丑。网站外观样式是由主题负责的，所以请直接通过CSS定制样式。

同时添加了一些实用的功能函数，如创建文章类型自定义分类法函数，分页函数等等。

= 显示一个 Slider 模块 =

`<?php echo do_shortcode('[slider type="home" tax="homecat" tag="shuang" speed="1000"  minSlides="1" maxSlides="1" num="4" thumbs="full" cut="18"]'); ?>`

参数：

* type：自定义文章类型的别名，默认为post
* tax：自定义分类法的别名，默认为category
* tag：自定义分类法的分类项目别名，默认为default
* num：显示的文章篇数，默认为6篇
* cut：标题自动截断的字符数，默认为26
* thumbs：显示的缩略图尺寸，默认为tumbnails
* 其他参数请参考bxslider官方文档

= 显示一个 Carousel 模块

`<?php echo do_shortcode('[slider type="home" tax="homecat" tag="images" speed="1000" minSlides="2" maxSlides="4" num="4" thumbs="full" cut="18"]'); ?>`

参数：

* type：自定义文章类型的别名，默认为post
* tax：自定义分类法的别名，默认为category
* tag：自定义分类法的分类项目别名，默认为default
* num：显示的文章篇数，默认为6篇
* cut：标题自动截断的字符数，默认为26
* thumbs：显示的缩略图尺寸，默认为tumbnails
* minSlides：屏幕变小时，Carousel 最少显示的图片数量
* maxSlides="4" 屏幕变大时，Carousel 最多显示的图片数量


= 创建自定义文章类型 =

如需要添加一个文章类型，只需要这样写：

`<?php if ( function_exists ("wizhi_create_types")) {
    wizhi_create_types( "pro", "产品", array( 'title', 'editor', 'author', 'thumbnail', 'comments' ), true );
} ?>`

参数：

* pro：自定义文章类型别名
* 产品：自定义文章类型名称
* array()：自定义文章类型支持的文章字段
* true：是否是公开的自定义文章类型，如果为false，文章类型在前台和后台看不到，不能查询

= 创建自定义分类法 =

需要添加一个自定义分类方法，只需要这样写：

`<?php if (function_exists ("wizhi_create_taxs") ) {
    wizhi_create_taxs( "procat", 'pro', "产品分类", true);
} ?>`

参数：

* procat：自定义分类法别名
* pro：自定义分类法关联到的文章类型
* 产品分类：自定义分类法的名称
* true：是否为层级分类，true为类似于分类目录的方法，false为类似于标签的方式

= BUG反馈和功能建议 =

BUG反馈和功能建议请发送邮件至：iwillhappy1314@gmail.com

作者网址：[WordPress智库](http://www.wpzhiku.com/ "WordPress CMS 插件")


== Installation ==

1. 上传插件到`/wp-content/plugins/` 目录
2. 在插件管理菜单激活插件

== Frequently Asked Questions ==


== Screenshots ==


== Changelog ==

= 1.3 =
* 增加了Slider效果和Carousel效果，基于[jQuery Bxslider](http://bxslider.com/)插件

= 1.2 =
* 精简CSS
* 增加了一些参数
* 完善文档

= 1.1 =
* 精简CSS
* 增加了一些参数
* 完善文档

= 1.0 =
* The first released