<?php if ( is_active_sidebar( 'sidebar-2' ) && wonderwall_magazine_get_theme_mod( 'footer_widgets_state', 'enabled' ) == 'enabled' ) : ?>

	<div id="footer-widgets" data-ddst-selector="#footer-widgets" data-ddst-label="Footer Widgets" data-ddst-no-support="typography,border">
		
		<div class="wrapper clearfix">

			<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div class="footer-widgets-1 col col-4">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div><!-- .footer-widgets-1 -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				<div class="footer-widgets-2 col col-4">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div><!-- .footer-widgets-2 -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
				<div class="footer-widgets-3 col col-4 col-last">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div><!-- .footer-widgets-3 -->
			<?php endif; ?>

		</div><!-- .wrapper -->

	</div><!-- #footer-widgets -->

<?php endif; ?>