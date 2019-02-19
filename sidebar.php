		<div id="sidebox">
<?php
	if ( is_active_sidebar( 'sidebar-ad-1' ) ) {
		dynamic_sidebar( 'sidebar-ad-1' );
	}
	if ( ! dynamic_sidebar( 'widget-siderbar-1' ) ) { ?>
			<div class="side-widget bg">
				<div class="side-widget-header layout"><h3><?php _e( 'Search', 'newstone' ); ?></h3></div>
					<?php get_search_form(); ?>
				<div class="side-widget-footer layout"></div>
			</div>
			<div class="side-widget bg">
				<div class="side-widget-header layout"><h3><?php _e( 'Categories', 'newstone' ); ?></h3></div>
					<ul>
						<?php wp_list_categories('title_li='); ?>
					</ul>
				<div class="side-widget-footer layout"></div>
			</div>
			<div id="side-widget-left">
				<div class="side-widget-s bg">
					<div class="side-widget-header-s layout"><h3><?php _e( 'Meta', 'newstone' ); ?></h3></div>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					<div class="side-widget-footer-s layout"></div>
				</div>
			</div>
			<div id="side-widget-right">
				<div class="side-widget-s bg">
					<div class="side-widget-header-s layout"><h3><?php _e( 'Archives', 'newstone' ); ?></h3></div>
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					<div class="side-widget-footer-s layout"></div>
				</div>
			</div>
<?php

	}
	if ( is_active_sidebar( 'widget-siderbar-2' ) ) {
		echo '<div id="side-widget-left">';
		dynamic_sidebar( 'widget-siderbar-2' );
		echo '</div>';
	}
	
	if ( is_active_sidebar( 'widget-siderbar-3' ) ) {
		echo '<div id="side-widget-right">';
		dynamic_sidebar( 'widget-siderbar-3' );
		echo '</div>';
	}

	echo '<div class="clearboth"></div>';

	if ( is_active_sidebar( 'widget-siderbar-4' ) ) 
		dynamic_sidebar( 'widget-siderbar-4' );
	
	if ( is_active_sidebar( 'sidebar-ad-2' ) ) {
		dynamic_sidebar( 'sidebar-ad-2' );
	}
?>
		</div>
		<div class="clearboth"></div>