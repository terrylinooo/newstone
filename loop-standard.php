				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newstone' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<div class="post-content">
						<?php 

						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
							the_excerpt();
						else :
							if ( !empty( $post->post_excerpt ) ) : 
								the_excerpt();
							else :
							 	the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'newstone' ) );
							endif;
						endif; 

						?>
					</div>

					<div class="post-meta">
						<div class="author icon"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'newstone' ), get_the_author() ); ?>"><?php the_author(); ?></a></div>
						<div class="time icon"><a href="<?php the_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php the_time(get_option('date_format')); ?></a></div>
						<div class="category icon"><?php the_category('<span class="comma">,</span> ') ?></div>
						<div class="comment icon"><?php comments_popup_link( __( '0 comments', 'newstone' ), __( '1 comment', 'newstone' ), __( '% comments', 'newstone' ) ); ?></div>
						<?php edit_post_link( __( 'Edit', 'newstone' ), '<div class="admin-edit icon">', '</div>' ); ?>
					</div>

					<?php if ( get_the_tags() ) : ?>

					<div class="post-tag">
						<div class="tag icon"><?php the_tags('', '<span class="comma">,</span> '); ?></div>
					</div>

					<?php endif; ?>

				</div>