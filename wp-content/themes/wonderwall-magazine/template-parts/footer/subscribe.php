<?php if ( wonderwall_magazine_get_theme_mod( 'footer_subscribe_state', 'enabled' ) == 'enabled' ) : ?>
	
	<?php if ( wonderwall_magazine_get_theme_mod( 'footer_subscribe_content', '[optinform]' ) != '[optinform]' || shortcode_exists( 'optinform' ) ) : ?>

		<?php
		$style = '';
		if ( wonderwall_magazine_get_theme_mod( 'footer_subscribe_bg_image', false ) ) {
			$style = 'background-image:url(' .  wonderwall_magazine_get_theme_mod( 'footer_subscribe_bg_image', '' ) .')';
		}
		?>

		<div class="footer-subscribe" style="<?php echo esc_attr( $style ); ?>">

			<div class="wrapper">

				<div class="footer-subscribe-title"><?php echo wonderwall_magazine_get_theme_mod( 'footer_subscribe_title', 'Subscribe to the newsletter' ); ?></div>
				<div class="footer-subscribe-subtitle"><?php echo wonderwall_magazine_get_theme_mod( 'footer_subscribe_subtitle', 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!' ); ?></div>
				<div class="footer-subscribe-content"><?php echo do_shortcode( wonderwall_magazine_get_theme_mod( 'footer_subscribe_content', '[optinform]' ) ); ?></div>
				<div class="footer-subscribe-after-content"><?php echo wonderwall_magazine_get_theme_mod( 'footer_subscribe_after_content', 'Don\'t Worry. We Don\'t Spam.' ); ?></div>

			</div><!-- .wrapper -->

		</div><!-- .footer-subscribe -->

	<?php endif; ?>

<?php endif; ?>