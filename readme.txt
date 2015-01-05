=== Plugin Name ===
Contributors: Amos Lee
Donate link: 
Tags: admin, post, pages, plugin, cms
Requires at least: 3.4
Tested up to: 4.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wizhi CMS 以简码的形式添加了中国一些CMS系统常用的调用标签，如织梦，PHPCMS等系统中的模板标签功能。

== Description ==

Wizhi CMS 以简码的形式添加了中国一些CMS系统常用的调用标签，如织梦，PHPCMS等系统中的模板标签功能。

如添加一个文章标题列表模块，只需要这样写：`<?php do_shortcode('[title_list type="post" tax="category" tag="default" num="6" cut="26" heading="0" time="true" sticky="true"]'); ?>`

插件中只包含了一些基本样式，所以看起来有点丑。网站外观样式是由主题负责的，所以请直接通过CSS定制样式。

同时添加了一些实用的功能函数，如创建文章类型自定义分类法函数，分页函数等等。

如需要添加一个文章类型，只需要这样写：

```
if ( function_exists ("wizhi_create_types")) {
    wizhi_create_types( "pro", "产品", array( 'title', 'editor', 'author', 'thumbnail', 'comments' ), true );
}
```

需要添加一个自定义分类方法，只需要这样写：

```
if (function_exists ("wizhi_create_taxs") ) {
    wizhi_create_taxs( "procat", 'pro', "产品分类" );
}
```

BUG反馈和功能建议请发送邮件至：iwillhappy1314@gmail.com


== Installation ==

1. 上传插件到`/wp-content/plugins/` 目录
2. 在插件管理菜单激活插件

== Frequently Asked Questions ==


== Screenshots ==


== Changelog ==

= 1.0 =
* The first released