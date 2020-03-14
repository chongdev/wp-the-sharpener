<nav id="navigation" data-ddst-selector="#navigation" data-ddst-label="Navigation" data-ddst-no-support="typography">
	
	<div class="wrapper">

		<div id="navigation-inner" data-ddst-selector="#navigation .menu > li > a" data-ddst-label="Navigation Items" data-ddst-no-support="background,border">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => false ) ); ?>
			<span class="navigation-active-line"></span>
		</div><!-- #navigation-main -->

	</div><!-- .wrapper -->

</nav><!-- #navigation -->

<div id="mobile-navigation">
	<span class="mobile-navigation-hook"><span class="fa fa-reorder"></span><?php esc_html_e( 'Navigation', 'wonderwall-magazine' ); ?></span>
	<?php wonderwall_magazine_mobile_nav(); ?>
</div><!-- #mobile-navigation -->