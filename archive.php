<?php get_header(); ?>
		<div id="mainbox" class="bg">
			<div class="main-layout-top layout"></div>
			<div id="content" role="main">
			<?php

				if ( have_posts() ) :
					the_post();
			?>
				<h1><?php

					if ( is_day() ) :
						printf( get_the_date() . '<span>' . __( 'Daily Archives', 'newstone' ) . '</span>' );
					
					elseif ( is_month() ) :
						printf( get_the_date( 'F Y' ) . '<span>' . __( 'Monthly Archives', 'newstone' ) . '</span>' );
					
					elseif ( is_year() ) :
						printf( get_the_date( 'Y' ) . '<span>' . __( 'Yearly Archives', 'newstone' ) . '</span>' );
					
					else :
						_e( 'Blog Archives', 'newstone' );

					endif;

				?></h1>

				<?php

					rewind_posts();

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

				endif;

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
