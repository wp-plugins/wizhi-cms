<?php
/*
Plugin Name:        Wizhi CMS
Plugin URI:         http://www.wpzhiku.com/
Description:        添加一些实用的功能，增加了一些效果类似dedecms(织梦)模板标签的一些简码。
Version:            1.0
Author:             Amos Lee
Author URI:         http://www.wpzhiku.com/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

define('WIZHI_CMS', plugin_dir_path(__FILE__));

//快速添加文章类型和分类法
require_once(WIZHI_CMS . 'modules/post_types.php');

//显示分页
require_once(WIZHI_CMS . 'modules/pagination.php');

//常用简码
require_once(WIZHI_CMS . 'modules/shortcodes.php');

//引入常用的字体图标
add_action( 'wp_enqueue_scripts', 'wizhi_zui_style' );
function wizhi_zui_style() {
	wp_register_style( 'wizhi-style', plugins_url('assets/zui.css', __FILE__) );
	wp_enqueue_style( 'wizhi-style' );
}