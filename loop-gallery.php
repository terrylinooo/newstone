				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newstone' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<div class="post-content">
<?php

if ( post_password_required() ) {
	the_content();
} else { 
	$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
	if ( $images ) {
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>
						<div class="gallery-thumb">
							<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
							<p><em> 
								<?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'newstone' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'newstone' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
								); ?>
							</em></p>
						</div>
<?php
	}
	the_excerpt();
}
?>
					</div>
					<div class="post-meta">
						<div class="author icon"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'newstone' ), get_the_author() ); ?>"><?php the_author(); ?></a></div>
						<div class="time icon"><a href="<?php the_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php the_time(get_option('date_format')); ?></a></div>
						<div class="category icon"><?php the_category('<span class="comma">,</span> ') ?></div>
						<div class="the-gallery icon"><a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'newstone' ); ?>"><?php _e( 'More Galleries', 'newstone' ); ?></a></div>
						<div class="comment icon"><?php comments_popup_link( __( '0 comments', 'newstone' ), __( '1 comment', 'newstone' ), __( '% comments', 'newstone' ) ); ?></div>
						<?php edit_post_link( __( 'Edit', 'newstone' ), '<div class="admin-edit icon">', '</div>' ); ?>
					</div>
							
					<?php if ( get_the_tags() ) : ?>

					<div class="post-tag">
						<div class="tag icon"><?php the_tags('', '<span class="comma">,</span> '); ?></div>
					</div>

					<?php endif; ?>
				</div>