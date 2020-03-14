<?php
		
	// defaults
	$header_bg_image = false;
	$header_main_style = '';

	// get global
	$header_bg_image_global = wonderwall_magazine_get_theme_mod( 'header_bg_image' );

	// get local
	$header_bg_image_local = false;
	if ( is_singular() ) {
		$header_bg_image_local = wonderwall_magazine_get_post_meta( get_the_ID(), 'header_bg_image' );
	}

	// get real
	if ( $header_bg_image_local ) {
		$header_bg_image = $header_bg_image_local;
	} elseif ( $header_bg_image_global ) {
		$header_bg_image = $header_bg_image_global;
	}

	// generate style
	if ( $header_bg_image ) {
		$header_main_style = 'background-image:url("' . $header_bg_image . '")';
	}

?>
<div id="header-main" style="<?php echo esc_attr( $header_main_style ); ?>">

	<div class="wrapper clearfix">

		<div id="logo" data-ddst-label="Logo" data-ddst-selector="#logo" data-ddst-no-support="typography">

			<?php
			
				// user defined logo image
				$logo_img_src = wonderwall_magazine_get_theme_mod( 'logo', false );
				$logo_img_retina_src = wonderwall_magazine_get_theme_mod( 'logo_retina', '' );

				// custom logo for page
				if ( is_singular() ) {
					$logo_img_src_local = wonderwall_magazine_get_post_meta( get_the_ID(), 'header_logo' );
					if ( $logo_img_src_local ) $logo_img_src = $logo_img_src_local;
				}

				// logo image class
				$logo_img_class = '';
				if ( $logo_img_retina_src !== '' ) {
					$logo_img_class = 'has-retina-ver';
				}
				
				// apply filters for logo src
				$logo_img_src = apply_filters( 'wonderwall_magazine_logo_src', $logo_img_src );
				
				if ( ! $logo_img_src ) :
					?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="<?php echo esc_attr( $logo_img_class );?>" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a><?php
				else :
					?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="<?php echo esc_attr( $logo_img_class );?>" src="<?php echo esc_attr( $logo_img_src ); ?>" data-retina-ver="<?php echo esc_attr( $logo_img_retina_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a><?php
				endif

			?>
		
		</div><!-- #logo -->

		<?php
			// vars
			$header_banner_url = wonderwall_magazine_get_theme_mod( 'header_banner_url', false );
			$header_banner_image = wonderwall_magazine_get_theme_mod( 'header_banner_image', false );
			$header_banner_code = wonderwall_magazine_get_theme_mod( 'header_banner_code', false );
		?>

		<?php if ( $header_banner_code ) : ?>
			<div id="header-banner" class="header-banner-code">
				<?php echo do_shortcode( $header_banner_code ); ?>
			</div><!-- #header-banner -->
		<?php elseif ( $header_banner_url && $header_banner_image ) : ?>
			<div id="header-banner" class="header-banner-image">
				<a href="<?php echo esc_url( $header_banner_url ); ?>" target="_blank" rel="nofollow"><img src="<?php echo esc_url( $header_banner_image ); ?>" alt="" /></a>
			</div><!-- #header-banner -->
		<?php endif; ?>

	</div><!-- .wrapper -->

</div><!-- #header-main -->