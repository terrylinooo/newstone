				<div id="comments">

					<?php if ( post_password_required() ) : ?>
					<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'newstone' ); ?></p></div>
					<?php return; endif; ?>

<?php if ( have_comments() ) : ?>

					<div id="comments-title">
						<h3><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'newstone' ), number_format_i18n( get_comments_number() ), '&#8220;<em>' . get_the_title() . '</em>&#8221;'); ?></h3>
					</div>

					<div class="commentlist">
						<ol>
							<?php wp_list_comments( array( 'callback' => 'newstone_comment' ) ); ?>
						</ol>
					</div>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<div class="navigation">
						<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older Comments', 'newstone' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&raquo;</span>', 'newstone' ) ); ?></div>
					</div>
					<?php endif; ?>

<?php endif; ?>
					<?php if ( ! comments_open() && ! is_page() ) : ?>
					<p class="nocomments"><?php _e( 'Comments are closed.', 'newstone' ); ?></p>
					<?php endif; ?>

					<?php comment_form(); ?>

				</div>