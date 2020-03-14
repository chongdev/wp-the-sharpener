<?php

// get section info
$section_info = wonderwall_magazine_get_section_info();

// banner url
$banner_url = false;
if ( isset( $section_info['banner_url'] ) ) {
	$banner_url = $section_info['banner_url'];
}

// banner image
$banner_image = false;
if ( isset( $section_info['banner_image'] ) ) {
	$banner_image = $section_info['banner_image'];
}

?>
<?php if ( $banner_image && $banner_url ) : ?>
	
	<div class="module-wrapper module-banner-wrapper <?php if ( $section_info['spacing'] == 'enabled' ) echo 'module-with-spacing'; ?>">

		<div class="module-banner wrapper">

			<a href="<?php echo esc_attr( $banner_url ); ?>" target="blank" rel="nofollow"><img src="<?php echo esc_url( $banner_image ); ?>" alt="" /></a>

		</div><!-- .module-banner -->

	</div><!-- .module-wrapper -->

<?php endif; ?>