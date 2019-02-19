				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newstone' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<?php if ( is_archive() || is_search() ) : ?>

					<div class="post-content">
						<?php the_excerpt(); ?>
					</div>

					<?php else : ?>

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

					<?php endif; ?>

					<div class="post-meta">
						<?php edit_post_link( __( 'Edit', 'newstone' ), '<div class="admin-edit icon">', '</div>' ); ?>
					</div>

				</div>