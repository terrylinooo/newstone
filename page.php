<?php get_header(); ?>

		<div id="mainbox" class="bg">
			<div class="main-layout-top layout"></div>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( is_front_page() ) : ?>

					<h2><?php the_title(); ?></h2>

					<?php else : ?>

					<h1><?php the_title(); ?></h1>

					<?php endif; ?>

					<div class="post-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newstone' ), 'after' => '</div>' ) ); ?>
					</div>
						
					<div class="post-meta">
						<?php edit_post_link( __( 'Edit', 'newstone' ), '<div class="admin-edit icon">', '</div>' ); ?>
					</div>
				</div>

				<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

			</div>
			<div class="main-layout-bottom layout"></div>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
