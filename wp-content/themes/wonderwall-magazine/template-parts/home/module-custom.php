<?php

// get section info
$section_info = wonderwall_magazine_get_section_info();

// default layout
if ( ! isset( $section_info['custom_content_layout'] ) ) {
	$section_info['custom_content_layout'] = 'wrapped';
}

// layout
if ( $section_info['custom_content_layout'] == 'wrapped' ) {
	$module_class = 'wrapper module-custom clearfix';
} else {
	$module_class = 'module-custom clearfix';
}

?>
<div class="module-wrapper module-custom-content-wrapper <?php if ( $section_info['spacing'] == 'enabled' ) echo 'module-with-spacing'; ?>">

	<div class="<?php echo esc_attr( $module_class ); ?>">

		<?php if ( isset( $section_info['custom_content'] ) ) : ?>
			<?php echo do_shortcode( $section_info['custom_content'] ); ?>
		<?php endif; ?>

	</div><!-- .module-custom -->

</div><!-- .module-wrapper -->
