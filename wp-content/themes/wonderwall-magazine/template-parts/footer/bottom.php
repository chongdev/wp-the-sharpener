<?php if ( wonderwall_magazine_get_theme_mod( 'footer_bottom_state', 'enabled' ) == 'enabled' ) : ?>

	<div id="footer-bottom" data-ddst-selector="#footer-bottom" data-ddst-label="Footer Bottom" data-ddst-no-support="typography,border">
		
		<div class="wrapper clearfix">
			
			<div id="footer-navigation" data-ddst-selector="#footer-navigation li a" data-ddst-label="Footer Copyright" data-ddst-no-support="background,border,spacing">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'fallback_cb' => false ) ); ?>
			</div><!-- #footer-navigation -->

			<div id="footer-copyright" data-ddst-selector="#footer-copyright" data-ddst-label="Footer Copyright" data-ddst-no-support="background,border,spacing">
				<?php echo do_shortcode( esc_html( wonderwall_magazine_get_theme_mod( 'footer_copy_text', 'Copyright &copy; Wonderwall 2017. All rights reserved.' ) ) ); ?>
			</div><!-- #footer-copyright -->

		</div><!-- .wrapper -->

	</div><!-- #footer-bottom -->

<?php endif; ?>