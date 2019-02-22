<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php newstone_custom_style(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php

	wp_head();
?>
</head>

<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php wp_head(); ?>

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
				<?php if ( is_singular() && has_post_thumbnail( $post->ID ) && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) && $image[1] >= 960 ) : ?>
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