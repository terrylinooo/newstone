<?php get_header(); ?>
		<div id="mainbox" class="bg">
			<div class="main-layout-top layout"></div>
			<div id="content" role="main">
				<h1><?php printf( single_cat_title( '', false ) . '<span>' . __( 'Category Archives', 'newstone' ) . '</span>' ); ?></h1>

				<?php

					$category_description = category_description();

					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

						while ( have_posts() ) :

							the_post();

							if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) )  : 
								get_template_part( 'loop', 'gallery' );

							elseif ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) : 
								get_template_part( 'loop', 'asides' );

							else :
								get_template_part( 'loop', 'standard' );

							endif;

						endwhile;

				?>

				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 'newstone' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'newstone' ) ); ?></div>
				</div>
				<?php endif; ?>
			</div>
			<div class="main-layout-bottom layout"></div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
