<?php get_header(); ?>
		<div id="mainbox-fullwidth" class="bg">
			<div class="main-fullwidth-layout-top layout"></div>
			<div id="content" role="main">
				<div id="post-0" class="post error404 not-found">
					<h1><?php _e( 'Not Found', 'newstone' ); ?></h1>

					<div class="post-content">
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'newstone' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
			<div class="main-fullwidth-layout-bottom layout"></div>
		</div>
<script type="text/javascript">
	document.getElementById('s') && document.getElementById('s').focus();
</script>
<?php get_footer(); ?>