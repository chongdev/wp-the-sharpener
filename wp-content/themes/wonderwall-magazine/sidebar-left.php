<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="sidebar" class="col col-4 sticky-sidebar-<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'sticky_sidebar_regular', 'enabled' ) ); ?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #sidebar -->
<?php endif; ?>
