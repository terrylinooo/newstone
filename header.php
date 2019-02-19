<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php newstone_custom_style(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	echo '<title>';

	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'newstone' ), max( $paged, $page ) );

	echo '</title>';

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	$blog_title = get_bloginfo('name');
	$blog_description = get_bloginfo('description');
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
	$heading_export = '<' . $heading_tag . ' id="site-title"><a href="' . home_url( '/' ) . '" title="' . esc_attr( $blog_title ) . '" rel="home">' . $blog_title . '</a></' . $heading_tag . '>';

	wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="base_bg">
	<div id="newstone">
		<div id="header-info">
			<div id="header-info-left">
				<?php echo $heading_export; ?>
			</div>
			<div id="header-info-right">
				<?php

					if ( is_active_sidebar( 'header-widget' ) ) 
						dynamic_sidebar( 'header-widget' );
					else
						echo '<div id="site-description">' . $blog_description . '</div>';
				?>
			</div>
			<div class="clearboth"></div>
		</div>
		<div id="header">
			<div id="the_menu" class="layout">
				<?php wp_nav_menu( array('container' => 'div', 'container_class' => 'menu_bar' ) ); ?>
			</div>
			<div id="feature-image" class="bg">
				<?php if ( is_singular() && has_post_thumbnail( $post->ID ) && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) && $image[1] >= HEADER_IMAGE_WIDTH ) : ?>
				<div id="show-feature-image" style="background:url(<?php echo $image[0]; ?>)"></div>				
				<?php elseif ( get_header_image() ) : ?>
				<div id="show-feature-image" style="background:url(<?php header_image(); ?>)"></div>
				<?php else : ?>
				<div id="show-feature-image" style="background:url(images/headers/bluesky.jpg)"></div>
				<?php endif; ?>
				<div id="feature-image-frame"></div>
			</div>
			<div id="header-shadow" class="layout"></div>
		</div>
		<div id="main">