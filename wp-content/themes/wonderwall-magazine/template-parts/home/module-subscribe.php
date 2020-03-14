<?php

// get section info
$section_info = wonderwall_magazine_get_section_info();

?>
<?php if ( $section_info['subscribe_content'] != '[optinform]' || shortcode_exists( 'optinform' ) ) : ?>

	<div class="module-wrapper module-subscribe-wrapper <?php if ( $section_info['spacing'] == 'enabled' ) echo 'module-with-spacing'; ?>" data-ddst-selector=".module-subscribe-inner.module-subscribe-style-full_width" data-ddst-label="Subscribe Module" data-ddst-no-support="typography,spacing">

		<div class="module-subscribe-inner module-subscribe-style-<?php echo esc_attr( $section_info['subscribe_style'] ); ?>" <?php if ( $section_info['subscribe_style'] == 'full_width' && isset( $section_info['subscribe_bg_image'] ) ) : ?>style="background-image:url('<?php echo esc_attr( $section_info['subscribe_bg_image'] ); ?>')"<?php endif; ?>>

			<div class="wrapper">

				<div class="subscribe clearfix" style="<?php if ( $section_info['subscribe_style'] == 'wrapped' && isset( $section_info['subscribe_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['subscribe_bg_image'] ); ?>')<?php endif; ?>">

					<?php if ( isset( $section_info['subscribe_title'] ) ) : ?>
						<h2 class="subscribe-title" data-ddst-selector=".subscribe-title" data-ddst-label="Subscribe Module - Title" data-ddst-no-support="background"><?php echo do_shortcode( $section_info['subscribe_title'] ); ?></h2>
					<?php endif; ?>

					<?php if ( isset( $section_info['subscribe_subtitle'] ) ) : ?>
						<h4 class="subscribe-subtitle" data-ddst-selector=".subscribe-subtitle" data-ddst-label="Subscribe Module - Subitle" data-ddst-no-support="background"><?php echo do_shortcode( $section_info['subscribe_subtitle'] ); ?></h2>
					<?php endif; ?>

					<?php if ( isset( $section_info['subscribe_content'] ) ) : ?>
						<div class="subscribe-main">
							<?php echo do_shortcode( $section_info['subscribe_content'] ); ?>
						</div><!-- -.subscribe-main -->
					<?php endif; ?>

					<?php if ( isset( $section_info['subscribe_after_content'] ) ) : ?>
						<div class="subscribe-after-content"><?php echo do_shortcode( $section_info['subscribe_after_content'] ); ?></div>
					<?php endif; ?>

				</div><!-- .subscribe -->

			</div><!-- .wrapper -->

		</div><!-- .module-subscribe-overlay -->

	</div><!-- .module-wrapper -->

<?php endif; ?>