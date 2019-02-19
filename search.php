<?php get_header(); ?>
		<div id="mainbox" class="bg">
			<div class="main-layout-top layout"></div>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
				<h1><?php printf( __( 'Search Results for: %s', 'newstone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php

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
				<?php else : ?>

				<div id="post-0" class="post no-results not-found">
					<h1><?php _e( 'Nothing Found', 'newstone' ); ?></h1>
					<div class="post-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'newstone' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>

				<?php endif; ?>
			</div>
			<div class="main-layout-bottom layout"></div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
