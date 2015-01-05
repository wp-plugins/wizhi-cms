<?php
/**
 * Maixun Shortcode
 *
 */

/*-----------------------------------------------------------------------------------*/
/* 显示文章
/*-----------------------------------------------------------------------------------*/

/* 以下为自定义功能，在主题升级的时候，直接拷贝到相关文件内即可。
*  增加了文章标题列表和slider 幻灯共4中简码功能。
*  使用方法：<?php echo do_shortcode('[page_cont id="1" cut="20" more="ture"]'); ?>
*/


/* 获取某个页面的内容 */

if ( ! function_exists( 'wizhi_shortcode_page_cont' ) ) {
	function wizhi_shortcode_page_cont( $atts ) {
		$default = array(
			'id'   => 1,
			'cut'  => 200,
			'more' => 'ture'
		);
		extract( shortcode_atts( $default, $atts ) );

		$page = get_post( $id );

		// 输出
		$retour  = '';
		$retour  .= wp_trim_words( $page->post_content, $cut, "..." );
		if ( $more == "ture" ) {
			$retour .= '<a target="_blank" href="' . get_page_link( $id ) . '">更多>></a>';
		} else {
			$retour .= '';
		}

		return $retour;
		wp_reset_postdata();
	}
}
add_shortcode( 'page_cont', 'wizhi_shortcode_page_cont' );


/* 根据自定义分类显示文章
*  输出标题文章列表时实现，默认带标题
*  使用方法：[title_list type="home" tax="home_tag" tag="yxdt" num="6" cut="26" heading="false" time="true" sticky="true"]
*  todo：可以实现更多的参数控制
*/
if ( ! function_exists( 'wizhi_shortcode_title_list' ) ) {
	function wizhi_shortcode_title_list( $atts ) {
		$default = array(
			'type'    => '',
			'tax'     => '',
			'tag'     => '',
			'offset'  => 0,
			'num'     => 8, // 数量: 显示文章数量，-1为全部显示
			'cut'     => 36, // 切断：标题截取的字符数
			'heading' => 'true',
			'time'    => 'false',
		);
		extract( shortcode_atts( $default, $atts ) );

		// 构建文章查询数组
		$args = array(
			'post_type'      => $type,
			'orderby'        => 'post_date',
			'order'          => 'DESC',
			'posts_per_page' => $num,
			'offset'         => $offset,
			'no_found_rows'  => true,
			'tax_query'      => array(
				array(
					'taxonomy' => $tax,
					'field'    => 'slug',
					'terms'    => $tag,
				)
			)
		);

		$cat          = get_term_by( 'slug', $tag, $tax );
        $cat_name     = $cat->name;
		$cat_link     = get_term_link( $tag, $tax );

		// 输出
		global $post;
		$myposts = get_posts( $args );
        $retour  = '';
		if ( $heading == 'false' ) {
			$retour .= '<ul class="zui-list">';
            foreach ( $myposts as $post ) :
                setup_postdata( $post );
                $retour .= '<li class="zui-list-item">';
                if ( $time == 'true' ) {
                    $retour .= '<span class="pull-right time">' . get_the_time( 'm-d' ) . '</span>';
                } else {
                    $retour .= '';
                }
                $retour .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
                $retour .= '</li>';
            endforeach;
            $retour .= '</ul>';
		} else {
            $retour .= '<div class="zui-box ' . $tag . '">';
			$retour .= '<div class="zui-box-head">';
            $retour .= '<h3 class="zui-box-head-title"><a href="' . $cat_link . '">' . $cat_name . '</a></h3>';
            $retour .= '<a class="more pull-right" href="' . $cat_link . '" target="_blank">更多></a>';
            $retour .= '</div>';
            $retour .= '<div class="zui-box-container"><ul class="zui-list">';
            foreach ( $myposts as $post ) :
                setup_postdata( $post );
                $retour .= '<li class="zui-list-item">';
                if ( $time == 'true' ) {
                    $retour .= '<span class="pull-right time">' . get_the_time( 'm-d' ) . '</span>';
                } else {
                    $retour .= '';
                }
                $retour .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
                $retour .= '</li>';
            endforeach;
            $retour .= '</ul></div></div>';
		}
		
		return $retour;
		wp_reset_postdata();
	}
}
add_shortcode( 'title_list', 'wizhi_shortcode_title_list' );


/* 图文混排样式简码
*  需要的参数：文章类型，分类法，分类，缩略图别名，标题字数，是否显示时间，内容字数
*  使用方法：<?php echo do_shortcode('[photo_list type="home" tax="home_tag" tag="yxdt" num="6" cut="26" heading="false" time="true" thumbs="maintain" cut="6" sticky="true" class="pure-u-1-5"]'); ?>
*/
if ( ! function_exists( 'wizhi_shortcode_photo_list' ) ) {
	function wizhi_shortcode_photo_list( $atts ) {
		$default = array(
			'type'    => '',
			'tax'     => '',
			'tag'     => '',
			'thumbs'  => '',
			'position'=> 'left',
			'num'     => '8',
			'cut'     => '20',
			'content' => '120',
			'heading' => true,
			'class'  => 'pure-u-1-4'
		);
		extract( shortcode_atts( $default, $atts ) );

		// 根据分类别名获取分类ID
		$args = array(
			'post_type'      => $type,
			'orderby'        => 'post_date',
			'order'          => 'DESC',
			'posts_per_page' => $num,
			'no_found_rows'  => true,
			'tax_query'      => array(
				array(
					'taxonomy' => $tax,
					'field'    => 'slug',
					'terms'    => $tag,
				)
			)
		);
		$cat          = get_term_by( 'slug', $tag, $tax );
		$cat_name    = $cat->name;
        $cat_link     = get_term_link( $tag, $tax );

		if($position == "left"){
			$position = "zui-media-cap-left";
		} elseif($position == "right"){
			$position = "zui-media-cap-right";
		} else {
			$position = "zui-media-cap-top";
		}

		// 输出
		global $post;
		$myposts = get_posts( $args );
        $retour  = '';

		if ( $heading == false ) {
	        $retour .= '<div class="zui-medias">';
            foreach ( $myposts as $post ) :
                setup_postdata( $post );
                $retour .= '<div class="' . $class . ' zui-media">';
                if ( ! empty( $thumbs ) ) {
                    $retour .= '<a class="zui-media-cap ' . $position . '" target="_blank" href="'. get_permalink(). '">';
                    if ( has_post_thumbnail() ) {
                        $retour .= get_the_post_thumbnail( $post->ID, $thumbs ); 
                    }
                    $retour .= '</a>';
                }
                if ( ! empty( $content ) ) {
                    $retour .= '<div class="zui-media-body">';
                    $retour .= '<div class="zui-media-body-title"><a href="' . get_permalink() . '">' . wp_trim_words( $post->post_title, $cut, "..." ) . '</a></div>';
                    $retour .= wp_trim_words( $post->post_content, $content, "..." );
                    $retour .= '</div>';
                } else {
                    $retour .= '<a href="' . get_permalink() . '">' . wp_trim_words( $post->post_title, $cut, "..." ) . '</a>';
                }
                $retour .= '</div>';
            endforeach;
            $retour .= '</div>';

        } else {
            $retour .= '<div class="zui-box ' . $tag . '">';
            $retour .= '<div class="zui-box-head">';
            $retour .= '<h3 class="zui-box-head-title"><a href="' . $cat_link . '">' . $cat_name . '</a></h3>';
            $retour .= '<a class="more pull-right" href="' . $cat_link . '" target="_blank">更多></a>';
            $retour .= '</div>';
            $retour .= '<div class="zui-box-container">';
            $retour .= '<div class="zui-box-content">';

                $retour .= '<div class="zui-medias">';
                foreach ( $myposts as $post ) :
                    setup_postdata( $post );
                    $retour .= '<div class="' . $class . ' zui-media">';
                    if ( ! empty( $thumbs ) ) {
                        $retour .= '<a class="zui-media-cap ' . $position . '" target="_blank" href="'. get_permalink(). '">';
                        if ( has_post_thumbnail() ) {
                            $retour .= get_the_post_thumbnail( $post->ID, $thumbs ); 
                        }
                        $retour .= '</a>';
                    }
                    if ( ! empty( $content ) ) {
                        $retour .= '<div class="zui-media-body">';
                        $retour .= '<div class="zui-media-body-title"><a href="' . get_permalink() . '">' . wp_trim_words( $post->post_title, $cut, "..." ) . '</a></div>';
                        $retour .= wp_trim_words( $post->post_content, $content, "..." );
                        $retour .= '</div>';
                    } else {
                        $retour .= '<a href="' . get_permalink() . '">' . wp_trim_words( $post->post_title, $cut, "..." ) . '</a>';
                    }
                    $retour .= '</div>';
                endforeach;
                $retour .= '</div>';

            $retour .= '</div>';
            $retour .= '</div>';
            $retour .= '</div>';

        }

		return $retour;
		wp_reset_postdata();
	}
}
add_shortcode( 'photo_list', 'wizhi_shortcode_photo_list' );


/* 分类自适应幻灯
*  替代方案为上面的slider幻灯，在性能上比较好
*  存在显示上的一些问题
*  使用方法：<?php echo do_shortcode('[rs_slider type="post" tax="category" tag="jingcai" speed="1000" num="4" thumbs="full" cut="46"]'); ?>
*/

if ( ! function_exists( 'wizhi_shortcode_rs_slider' ) ) {
	function wizhi_shortcode_rs_slider( $atts ) {
		$default = array(
			'type'   => '',
			'tax'    => '',
			'tag'    => '',
			'num'    => 8,
			'cut'    => 36,
			'thumbs' => 'show',
			'speed'  => '1000',
		);
		extract( shortcode_atts( $default, $atts ) );

		// 生成 $options 数组

		$id      = $type;
		$options = array(
			'speed' => $speed,
			'tax'   => $tax,
		);

		// 生成文章查询参数
		$args = array(
			'post_type'      => $type,
			'posts_per_page' => $num,
			'orderby'        => 'post_date',
			'order'          => 'DESC',
			'no_found_rows'  => true,
			'tax_query'      => array(
				array(
					'taxonomy' => $tax,
					'field'    => 'slug',
					'terms'    => $tag,
				)
			)
		);

		$cat  = get_term_by( 'slug', $tag, $tax );
		$name = $cat->name;

		// 输出
		ob_start();
		wizhi_rs_slider_js( $id, $options );
		global $post;
		$myposts = get_posts( $args );
		echo '<script type="text/javascript" src="http://cdn.staticfile.org/ResponsiveSlides.js/1.53/responsiveslides.min.js"></script>';
		echo '<div class="rspics" id="cycle-' . $tax . '">';
		echo '<ul class="rslides fix" id="slider-' . $tax . '">';
		foreach ( $myposts as $post ) :
			setup_postdata( $post );
			echo '<li class="z slider"><a class="item-' . $tax . ' hide" href="' . get_permalink() . '" title="' . get_the_title() . '">';
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( $thumbs );
			}
			echo '<p class="caption">' . wp_trim_words( $post->post_title, $cut, "..." ) . '</p></a></li>';
		endforeach;
		echo '</ul></div>';

		return ob_get_clean();
		wp_reset_postdata();
	}
}
add_shortcode( 'rs_slider', 'wizhi_shortcode_rs_slider' );


/*  添加分类缩略图滚动效果
    输出的js右wizhi_cycle_carousel_js函数控制
*/
if ( ! function_exists( 'wizhi_shortcode_thumb_carousel' ) ) {
	function wizhi_shortcode_thumb_carousel( $atts ) {
		$default = array(
			'type'  => '',
			'tax'   => '',
			'tag'   => '',
			'slug'  => '',
			'num'   => '',
			'thumb' => '',
			'auto'  => 1600,
			'speed' => 1000,
			'cut'   => 20,
			'arrow' => 'true'
		);
		extract( shortcode_atts( $default, $atts ) );

		//转换slug为分类ID
		$slug = get_category_by_slug( $slug );
		$id   = $slug->term_id;

		// 生成 $options 数组
		$options = array(
			'slug'  => $slug,
			'num'   => $num,
			'thumb' => $thumb,
			'auto'  => $auto,
			'speed' => $speed,
			'cut'   => $cut,
		);

		// 生成文章查询参数
		$args = array(
			'post_type'      => $type,
			'orderby'        => 'post_date',
			'order'          => 'DESC',
			'posts_per_page' => $num,
			'no_found_rows'  => true,
			'tax_query'      => array(
				array(
					'taxonomy' => $tax,
					'field'    => 'slug',
					'terms'    => $tag,
				)
			)
		);

		// 输出
		ob_start();
		wizhi_cycle_carousel_js( $id, $options );
		global $post;
		$myposts = get_posts( $args );
		echo '<script type="text/javascript" src="http://cdn.staticfile.org/jcarousel/0.3.1/jquery.jcarousel.min.js"></script>';
		echo '<div class="scroll" id="scroll-' . $id . '">';
		echo '<ul>';
		foreach ( $myposts as $post ) :
			setup_postdata( $post );
			echo '<li class="cabox">';
			echo '<a target="_blank" href="' . get_permalink() . '" title="' . get_the_title() . '">';
			the_post_thumbnail( $thumb );
			echo '<div class="tc">' . wp_trim_words( $post->post_title, $cut, "..." ) . '</a></div>';
		endforeach;
		echo '</li></ul>';
		echo '</div>';
		if ( $arrow == 'ture' ) {
			echo '<a class="prev">前进</a><a class="next">后退</a>';
		}

		return ob_get_clean();
		wp_reset_postdata();
	}
}
add_shortcode( 'thumb_scroll', 'wizhi_shortcode_thumb_carousel' );


/**-----------------------------------------------------------------------------------*/
/* Slider Javascript
/* Jquery Cycle 幻灯所需的JS
/* -----------------------------------------------------------------------------------
*/

if ( ! function_exists( 'wizhi_rs_slider_js' ) ) {
	function wizhi_rs_slider_js( $id, $options ) {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(window).load(function () {
					$('#slider-<?php echo $options['tax'] ?>').responsiveSlides({
						speed: <?php echo $options['speed'] ?>,
						auto : true,
						pager: true,
						nav  : false
					});
				});
			});
		</script>
	<?php
	}
}

/**
 *  图片滚动carousel 效果所需的JS
 *
 * @since 2.0.0
 */

if ( ! function_exists( 'wizhi_cycle_carousel_js' ) ) {
	function wizhi_cycle_carousel_js( $id, $options ) {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(window).load(function () {
					$('#scroll-<?php echo $id; ?>').jCarouselLite({
						btnNext: ".next",
						btnPrev: ".prev",
						speed  : <?php echo $options['speed'] ?>,
						auto   : <?php echo $options['auto'] ?>,
					});
				});
			})
		</script>
	<?php
	}
}