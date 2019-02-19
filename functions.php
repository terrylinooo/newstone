<?php

if ( ! isset( $content_width ) )
	$content_width = 640;

function newstone_admin_header_style() {
	echo "<style type=\"text/css\">\n";
	echo "#headimg {\n";
	echo "	border-bottom: 1px solid #000\n";
	echo "	border-top: 4px solid #000\n";
	echo "}\n";
	echo "</style>";
}
function newstone_setup() {

	add_editor_style();
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'newstone', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'newstone' ),
	) );

	add_custom_background();

	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/headers/bluesky.jpg' );

	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'newstone_header_image_width', 960 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'newstone_header_image_height', 130 ) );

	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	add_custom_image_header( '', 'newstone_admin_header_style' );

	register_default_headers( array(
		'greenleaf' => array(
			'url' => '%s/images/headers/greenleaf.jpg',
			'thumbnail_url' => '%s/images/headers/greenleaf-thumbnail.jpg',
			'description' => __( 'Green Leaf', 'newstone' )
		),
		'bluesky' => array(
			'url' => '%s/images/headers/bluesky.jpg',
			'thumbnail_url' => '%s/images/headers/bluesky-thumbnail.jpg',
			'description' => __( 'Blue Sky', 'newstone' )
		)
	) );
}
add_action( 'after_setup_theme', 'newstone_setup' );

function newstone_continue_reading_link() {
	return '&hellip; <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'newstone' ) . '</a>';
}
function newstone_excerpt_length($length) {
	return 80;
}

function newstone_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'newstone_page_menu_args' );
add_filter( 'excerpt_length', 'newstone_excerpt_length');
add_filter( 'excerpt_more', 'newstone_continue_reading_link' );

function newstone_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= newstone_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'newstone_custom_excerpt_more' );
add_filter( 'use_default_gallery_style', '__return_false' );

if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) ) {
	function newstone_remove_gallery_css( $css ) {
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}
	add_filter( 'gallery_style', 'newstone_remove_gallery_css' );
}

if ( ! function_exists( 'newstone_comment' ) ) :

function newstone_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>" class="commentbox">
		<?php echo get_avatar( $comment, 32 ); ?>
		<div class="comment-author"><?php echo get_comment_author_link() ; ?></div>

		<div class="comment-meta">
			<?php
				echo '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '" title="' . sprintf( __( '%1$s at %2$s', 'newstone' ), get_comment_date(),  get_comment_time() ) . '">' . newstone_comment_time( get_comment_date('j-n-Y'), get_comment_time('H:i:s') ) . '</a>';
			 	edit_comment_link( __( '(Edit)', 'newstone' ), ' ' ); 
			 	echo ' ';
			 	comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( '(Reply)', 'newstone' )) ) );
			 ?>
		</div>
					 
		<?php if ( $comment->comment_approved == '0' ) : ?>
		<div class="comment-body"><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'newstone' ); ?></em></div>
		<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

	</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
	<p><?php _e( 'Pingback:', 'newstone' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'newstone' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function newstone_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 300 (Top)', 'newstone' ),
		'id' => 'widget-siderbar-1',
		'description' => __( 'This 300px width widget is in the top of the sidebar.', 'newstone' ),
		'before_widget' => '<div class="side-widget bg">',
		'after_widget' => '<div class="side-widget-footer layout"></div></div>',
		'before_title' => '<div class="side-widget-header layout"><h3>',
		'after_title' => '</h3></div>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar 140 (Left)', 'newstone' ),
		'id' => 'widget-siderbar-2',
		'description' => __( 'This 140px width widget is in the middle left of the sidebar.', 'newstone' ),
		'before_widget' => '<div class="side-widget-s bg">',
		'after_widget' => '<div class="side-widget-footer-s layout"></div></div>',
		'before_title' => '<div class="side-widget-header-s layout"><h3>',
		'after_title' => '</h3></div>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar 140 (Right)', 'newstone' ),
		'id' => 'widget-siderbar-3',
		'description' => __( 'This 140px width widget is in the middle right of the sidebar.', 'newstone' ),
		'before_widget' => '<div class="side-widget-s bg">',
		'after_widget' => '<div class="side-widget-footer-s layout"></div></div>',
		'before_title' => '<div class="side-widget-header-s layout"><h3>',
		'after_title' => '</h3></div>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar 300 (Bottom)', 'newstone' ),
		'id' => 'widget-siderbar-4',
		'description' => __( 'This 300px width widget is in the bottom of the sidebar.', 'newstone' ),
		'before_widget' => '<div class="side-widget bg">',
		'after_widget' => '<div class="side-widget-footer layout"></div></div>',
		'before_title' => '<div class="side-widget-header layout"><h3>',
		'after_title' => '</h3></div>',
	) );
	register_sidebar( array(
		'name' => __( 'Ad 1: Header 468*60', 'newstone' ),
		'id' => 'header-ad',
		'description' => __( 'This widget is for placing common 468x60 Ad in the header area. Please use "Text" to place the Ad.', 'newstone' ),
		'before_widget' => '<div class="header-ad">',
		'after_widget' => '</div>',
		'before_title' => '<div class="empty">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Ad 2: Sidebar 300*250', 'newstone' ),
		'id' => 'sidebar-ad-1',
		'description' => __( 'This widget is for placing common 300x250 Ad in the top of the sidebar. Please use "Text" widget to place the Ad.', 'newstone' ),
		'before_widget' => '<div class="side-widget bg"><div class="side-widget-header-ad layout"></div>',
		'after_widget' => '<div class="side-widget-footer layout"></div></div>',
		'before_title' => '<div class="empty">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Ad 3: Sidebar 300*250', 'newstone' ),
		'id' => 'sidebar-ad-2',
		'description' => __( 'This widget is for placing common 300x250 Ad in the bottom of the sidebar. Please use "Text" widget to place the Ad.', 'newstone' ),
		'before_widget' => '<div class="side-widget bg"><div class="side-widget-header-ad layout"></div>',
		'after_widget' => '<div class="side-widget-footer layout"></div></div>',
		'before_title' => '<div class="empty">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Ad 4: Footer 728*90', 'newstone' ),
		'id' => 'footer-ad',
		'description' => __( 'This widget is for placing common 728x90 Ad in the footer area. Please use "Text" widget to place the Ad.', 'newstone' ),
		'before_widget' => '<div class="footer-ad">',
		'after_widget' => '</div>',
		'before_title' => '<div class="empty">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Javascript', 'newstone' ),
		'id' => 'footer-javascript',
		'description' => __( 'You can put Javascript here for your needs. Please use "Text" to place the Javascript. It will be placed in front of </body> tag.', 'newstone' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="empty">',
		'after_title' => '</div>',
	) );
}
function newstone_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}

add_action( 'widgets_init', 'newstone_widgets_init' );
add_action( 'widgets_init', 'newstone_remove_recent_comments_style' );

function tagcloud_fontsize_reset($args = array()) { 
   $args['smallest'] = 11;
   $args['largest'] = 11; 
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'tagcloud_fontsize_reset', 90);

function clean_img_height($img_src){ 
	return preg_replace('/\<(.*?)(height="(.*?)")(.*?)\>/i', '<$1$4>', $img_src);
}

add_filter('get_image_tag', 'clean_img_height', 91); 


function img_caption_shortcode_remove_width($attr, $content = null) {

	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract( shortcode_atts( array( 'id'	=> '', 'align'	=> 'alignnone', 'width'	=> '', 'caption' => '' ), $attr) );

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_shortcode('wp_caption', 'img_caption_shortcode_remove_width');
add_shortcode('caption', 'img_caption_shortcode_remove_width');

function newstone_fix_ie() {
	echo "<!--[if (IE 6)]>\n";
	echo "<style type=\"text/css\">\n";
	echo "body {\n";
	echo "	behavior: url(\"" . get_template_directory_uri() .  "/csshover3.htc\")\n";
	echo "}\n";
	echo "</style>\n";
	echo "<![endif]-->\n";
}

function newstone_custom_style() {
	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 6' ) == TRUE ) {
		echo get_template_directory_uri() . '/style_ie6.css';
		add_action('wp_head', 'newstone_fix_ie');
	} else {
		echo get_template_directory_uri() . '/style.css';
	}
}
function newstone_comment_time( $comments_day, $comments_time ) {

	$newstone_second = 1;
	$newstone_minute = 60;
	$newstone_hour = 3600;
	$newstone_day = 86400;
	$newstone_week = 604800;
	$newstone_month = 2592000;
	$newstone_year = 31536000;
	
	$array_time = explode( ':', $comments_time );
	$array_day = explode( '-', $comments_day );

	$newstone_comment_timestamp =  mktime ($array_time[0], $array_time[1], $array_time[2], $array_day[1], $array_day[0], $array_day[2]);
	$newstone_current_timestamp = current_time( 'timestamp', 1 );
	
	$time_difference = $newstone_current_timestamp - $newstone_comment_timestamp;
		
	if ( $time_difference >= $newstone_minute && $time_difference < $newstone_hour ) {
		
		$comments_time_value = floor( $time_difference / $newstone_minute );
		
		if ( $comments_time_value == 1 ) 
			return __( '1 minute ago', 'newstone' );
		else 
			return sprintf( __( '%s minutes ago', 'newstone' ), $comments_time_value );
		
	} elseif ( $time_difference >= $newstone_hour && $time_difference < $newstone_day ) {
		
		$comments_time_value = floor( $time_difference / $newstone_hour );
		
		if ( $comments_time_value == 1 ) 
			return __( '1 hour ago', 'newstone' );
		else 
			return sprintf( __( '%s hours ago', 'newstone' ), $comments_time_value );

	} elseif ( $time_difference >= $newstone_day && $time_difference < $newstone_week ) {
		
		$comments_time_value = floor( $time_difference / $newstone_day );
		
		if ( $comments_time_value == 1 ) 
			return __( '1 day ago', 'newstone' );
		else 
			return sprintf( __( '%s days ago', 'newstone' ), $comments_time_value );

	} elseif ( $time_difference >= $newstone_week && $time_difference < $newstone_month ) {
		
		$comments_time_value = floor( $time_difference / $newstone_week );
		
		if ( $comments_time_value == 1 ) 
			return __( '1 week ago', 'newstone' );
		else 
			return sprintf( __( '%s weeks ago', 'newstone' ), $comments_time_value );

	} elseif ( $time_difference >= $newstone_month && $time_difference < $newstone_year ) {
		
		$comments_time_value = floor( $time_difference / $newstone_month );
		
		if ( $comments_time_value == 1 ) 
			return __( '1 month ago', 'newstone' );
		else 
			return sprintf( __( '%s months ago', 'newstone' ), $comments_time_value );

	} elseif ( $time_difference >= $newstone_year ) {
		
		$comments_time_value = floor( $time_difference / $newstone_year );
		
		if ( $comments_time_value == 1 ) 
			return __( '1 year ago', 'newstone' );
		else 
			return sprintf( __( '%s years ago', 'newstone' ), $comments_time_value );

	} else { 
		return __( 'active less than 1 minute ago', 'newstone' );
	}
}
