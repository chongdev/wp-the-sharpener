<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<?php
		$sticky_sidebar = 'disabled';
		if ( is_singular( 'post' ) ) {
			$sticky_sidebar = wonderwall_magazine_get_theme_mod( 'sticky_sidebar_post', 'enabled' );
		} elseif ( is_singular( 'page' ) ) {
			$sticky_sidebar = wonderwall_magazine_get_theme_mod( 'sticky_sidebar_page', 'enabled' );
		}
		if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'sticky_sidebar' ) ) {
			$sticky_sidebar_custom = wonderwall_magazine_get_post_meta( get_the_ID(), 'sticky_sidebar' );
			if ( $sticky_sidebar_custom !== 'default' ) {
				$sticky_sidebar = $sticky_sidebar_custom;
			}
		}
	?>
	<aside id="sidebar" class="col col-4 col-last sticky-sidebar-<?php echo esc_attr( $sticky_sidebar ); ?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #sidebar -->
<?php endif; ?>
