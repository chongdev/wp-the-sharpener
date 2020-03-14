<?php
	// vars
	$footer_banner_url = wonderwall_magazine_get_theme_mod( 'footer_banner_url', false );
	$footer_banner_image = wonderwall_magazine_get_theme_mod( 'footer_banner_image', false );
	$footer_banner_code = wonderwall_magazine_get_theme_mod( 'footer_banner_code', false );
?>

<?php if ( $footer_banner_code ) : ?>
	<div id="footer-banner" class="footer-banner-code">
		<div class="wrapper">
			<?php echo do_shortcode( $footer_banner_code ); ?>
		</div><!-- .wrapper -->
	</div><!-- #footer-banner -->
<?php elseif ( $footer_banner_url && $footer_banner_image ) : ?>
	<div id="footer-banner" class="footer-banner-image">
		<div class="wrapper">
			<a href="<?php echo esc_url( $footer_banner_url ); ?>" target="_blank" rel="nofollow"><img src="<?php echo esc_url( $footer_banner_image ); ?>" alt="" /></a>
		</div><!-- .wrapper -->
	</div><!-- #footer-banner -->
<?php endif; ?>