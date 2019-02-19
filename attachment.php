<?php get_header(); ?>
		<div id="mainbox-fullwidth" class="bg">
			<div class="main-fullwidth-layout-top layout"></div>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( ! empty( $post->post_parent ) ) : ?>
				<div class="attachment_return_link">
					<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'newstone' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php 
					printf( __( '<span class="meta-nav">&laquo;</span> %s', 'newstone' ), get_the_title( $post->post_parent ) ); ?></a>
				</div>
				<?php endif; ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="post-content">
						<?php

						if ( wp_attachment_is_image() ) :
							$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
									break;
							}
							$k++;

							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) )
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else
									$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							} else {
								$next_attachment_url = wp_get_attachment_url();
							}
						?>
						
						<div class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_width  = apply_filters( 'newstone_attachment_size', 890 );
							$attachment_height = apply_filters( 'newstone_attachment_height', 890 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) );
						?></a></div>



						<?php else : ?>

						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>

						<?php endif; ?>
						<div id="nav-below" class="navigation">
							<div class="nav-previous"><?php previous_image_link( false ); ?></div>
							<div class="nav-next"><?php next_image_link( false ); ?></div>
						</div>

						<div class="post-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>


						<?php 
							the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'newstone' ) );
							wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newstone' ), 'after' => '</div>' ) ); 
						?>
					</div>
					<div class="post-meta">
						<div class="author icon"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'newstone' ), get_the_author() ); ?>"><?php the_author(); ?></a></div>
						<div class="time icon"><a href="<?php the_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php the_time(get_option('date_format')); ?></a></div>
						<div class="magnifier icon"><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( __( 'Link to full-size image', 'newstone' ) ); ?>"><?php
							if ( wp_attachment_is_image() ) {
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Full size is %1$s &times; %2$s pixels', 'newstone' ), $metadata['width'], $metadata['height'] );
							} ?></a></div>
						<div class="comment icon"><?php comments_popup_link( __( 'Leave a comment', 'newstone' ), __( '1 Comment', 'newstone' ), __( '% Comments', 'newstone' ) ); ?></div>
						<?php edit_post_link( __( 'Edit', 'newstone' ), '<div class="admin-edit icon">', '</div>' ); ?>
					</div>
				</div>

				<?php comments_template(); ?>

				<?php endwhile; ?>

			<?php endif; ?>

			</div>
			<div class="main-fullwidth-layout-bottom layout"></div>
		</div>
<?php get_footer(); ?>
