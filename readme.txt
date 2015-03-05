=== Plugin Name ===
Contributors: Amos Lee
Donate link: 
Tags: admin, post, pages, plugin, cms
Requires at least: 3.4
Tested up to: 4.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wizhi CMS 以简码的形式添加了中国一些CMS系统常用的调用标签，如织梦，PHPCMS等系统中的模板标签功能。

== Description ==

Wizhi CMS 为WordPress增加了快速添加自定义文章类型和自定义分类法的功能，以简码的形式添加了中国一些CMS系统常用的调用标签，如织梦，PHPCMS等系统中的模板标签功能。


= 自定义文章类型 =

如需要添加一个文章类型，只需要这样写：

`<?php if ( function_exists ("wizhi_create_types")) {
    wizhi_create_types( "pro", "产品", array( 'title', 'editor', 'author', 'thumbnail', 'comments' ), true );
} ?>`

参数：

* pro：自定义文章类型别名
* 产品：自定义文章类型名称
* array()：自定义文章类型支持的文章字段
* true：是否是公开的自定义文章类型，如果为false，文章类型在前台和后台看不到，不能查询


= 自定义分类法 =

需要添加一个自定义分类方法，只需要这样写：

`<?php if (function_exists ("wizhi_create_taxs") ) {
    wizhi_create_taxs( "procat", 'pro', "产品分类", true);
} ?>`


= 文章标题列表 =

如添加一个文章标题列表模块，只需要这样写：

`<?php echo do_shortcode('[title_list type="post" tax="category" tag="default" num="6" cut="26" heading="0" time="true"]'); ?>`

参数：

* type：自定义文章类型的别名，默认为post
* tax：自定义分类法的别名，默认为category
* tag：自定义分类法的分类项目别名，默认为default
* num：显示的文章篇数，默认为6篇
* cut：标题自动截断的字符数，默认为26
* heading：是否显示以自定义分类法分类项目作为名称的标题，含有一个“更多”的链接，如果没有设置tax或tag参数，标题不会显示
* time：是否显示文章发表的时间，默认为不现实，设置为true显示


= 文章缩略图列表 =

如需显示一个文章的图文列表，只需要这样写：

`<?php echo do_shortcode('[photo_list type="home" tax="home_tag" tag="yxdt" num="6" cut="26" heading="false" time="true" thumbs="maintain" cut="6" class="pure-u-1-5" position="left"]'); ?>`

和上面的title_list相比，增加了以下参数：

* thumbs：显示的缩略图尺寸，默认为tumbnails
* class：附加的图文列表上的CSS类，默认为“pure-u-1-4”，一列显示4个文章。
* position：图片显示的位置，不设置默认为显示在文章顶部，可选项为“left”显示在文章左侧或“right”显示在文章右侧

= 文章标题和缩略图自定义链接 =

文章列表和图片列表有时候需要自定义链接，本插件通过自定义字段实现了这个功能。

需要使用自定义链接功能时，添加meta_key为“cus_links”的自定义字段，如果插件简码检测到这个字段，就会自动把标题和图片链接换成自定义链接。

因为这个功能需求比较小，也为了不增加插件的复杂性，插件就不提供自定义MetaBox了，需要的朋友请自定添加。

参数：

* procat：自定义分类法别名
* pro：自定义分类法关联到的文章类型
* 产品分类：自定义分类法的名称
* true：是否为层级分类，true为类似于分类目录的方法，false为类似于标签的方式


= 其他说明 =

插件中只包含了一些基本样式，所以看起来有点丑。网站外观样式是由主题负责的，所以请直接通过CSS定制样式。

同时添加了一些实用的功能函数，如创建文章类型自定义分类法函数，分页函数等等。


= BUG反馈和功能建议 =

插件会在我自己的使用过程中逐步完善，如果你发现了插件的BUG，或者有任何功能建议。请发送邮件至：iwillhappy1314@gmail.com

作者网址：[WordPress智库](http://www.wpzhiku.com/ "WordPress CMS 插件")


== Installation ==

1. 上传插件到`/wp-content/plugins/` 目录
2. 在插件管理菜单激活插件

== Frequently Asked Questions ==


== Screenshots ==


== Changelog ==

= 1.2 =
* 加入了自定义链接功能
* 修改了文档中的一些问题

= 1.1 =
* 精简CSS
* 增加了一些参数
* 完善文档

= 1.0 =
* The first released