<?php get_header(); ?>
		<div id="mainbox" class="bg">
			<div class="main-layout-top layout"></div>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="post-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newstone' ), 'after' => '</div>' ) ); ?>
					</div>

					<div class="post-meta">
						<div class="author icon"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'newstone' ), get_the_author() ); ?>"><?php the_author(); ?></a></div>
						<div class="time icon"><a href="<?php the_permalink(); ?>" title="<?php echo get_the_time(); ?>"><?php the_time(get_option('date_format')); ?></a></div>
						<div class="category icon"><?php the_category('<span class="comma">,</span> ') ?></div>
						<div class="comment icon"><?php comments_popup_link( __( 'Leave a comment', 'newstone' ), __( '1 Comment', 'newstone' ), __( '% Comments', 'newstone' ) ); ?></div>
						<?php edit_post_link( __( 'Edit', 'newstone' ), '<div class="admin-edit icon">', '</div>' ); ?>
					</div>
					<?php if ( get_the_tags() ) : ?>

					<div class="post-tag">
						<div class="tag icon"><?php the_tags('', '<span class="comma">,</span> '); ?></div>
					</div>

					<?php endif; ?>

					<?php if ( get_the_author_meta( 'description' ) ) :  ?>

					<div id="post-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'newstone_author_bio_avatar_size', 60 ) ); ?>
						</div>
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'newstone' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&raquo;</span>', 'newstone' ), get_the_author() ); ?>
								</a>
							</div>
						</div>
						
					</div>
					<?php endif; ?>

				</div>

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link(); ?></div>
					<div class="nav-next"><?php next_post_link(); ?></div>
				</div>

				<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

			</div>
			<div class="main-layout-bottom layout"></div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
