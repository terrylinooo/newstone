		</div>
		<div id="footer">
			<?php if ( is_active_sidebar( 'footer-ad' ) ) {
			echo '<div id="footer-widget">';
			dynamic_sidebar( 'footer-ad' );
			echo '</div>';
			} ?>
			<div class="footer-line layout"></div>
			<div id="credit">
				<div id="credit-left">
					<div id="site-info"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></div>
				</div>
				<?php if ( is_home() || is_front_page() ) : ?>
				<div id="credit-right">
					<div id="theme-designer" class="icon"><a href="<?php echo esc_url( __( 'https://terryl.in/', 'newstone' ) ); ?>">NewStone theme by TerryL</a>.</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
</div>
<?php wp_footer();
if ( is_active_sidebar( 'footer-javascript' ) ) {
	echo '<div class="empty">';
	dynamic_sidebar( 'footer-javascript' );
	echo '</div>';
} ?>
</body>
</html>
