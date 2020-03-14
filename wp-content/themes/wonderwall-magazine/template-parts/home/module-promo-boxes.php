<?php

// get section info
$section_info = wonderwall_magazine_get_section_info();

?>
<div class="module-wrapper module-promo-boxes-wrapper <?php if ( $section_info['spacing'] == 'enabled' ) echo 'module-with-spacing'; ?>">

	<div class="wrapper promo-boxes clearfix">

		<?php if ( isset( $section_info['promo_box_1_title'] ) ) : ?>

			<div class="promo-box col col-4" style="<?php if ( isset( $section_info['promo_box_1_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['promo_box_1_bg_image'] ); ?>')<?php endif; ?>">

				<div class="promo-box-overlay"></div>

				<div class="promo-box-inner">

					<div class="promo-box-main">
						<h4 class="promo-box-title" data-ddst-label="Promo Box - Title" data-ddst-selector=".promo-box-title" data-ddst-no-support="background,border"><?php echo do_shortcode( $section_info['promo_box_1_title'] ); ?></h4>					
					</div><!-- .promo-box-main -->

				</div><!-- .promo-box-inner -->

				<?php if ( isset( $section_info['promo_box_1_url'] ) ) : ?>
					<a href="<?php echo esc_url( $section_info['promo_box_1_url'] ); ?>" class="promo-box-link"></a>
				<?php endif; ?>

			</div><!-- .promo-box -->

		<?php endif; ?>

		<?php if ( isset( $section_info['promo_box_2_title'] ) ) : ?>

			<div class="promo-box col col-4" style="<?php if ( isset( $section_info['promo_box_2_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['promo_box_2_bg_image'] ); ?>')<?php endif; ?>">

				<div class="promo-box-overlay"></div>

				<div class="promo-box-inner">

					<div class="promo-box-main">
						<h4 class="promo-box-title"><?php echo do_shortcode( $section_info['promo_box_2_title'] ); ?></h4>
					</div><!-- .promo-box-main -->

				</div><!-- .promo-box-inner -->

				<?php if ( isset( $section_info['promo_box_2_url'] ) ) : ?>
					<a href="<?php echo esc_url( $section_info['promo_box_2_url'] ); ?>" class="promo-box-link"></a>
				<?php endif; ?>

			</div><!-- .promo-box -->

		<?php endif; ?>

		<?php if ( isset( $section_info['promo_box_3_title'] ) ) : ?>

			<div class="promo-box col col-4 col-last" style="<?php if ( isset( $section_info['promo_box_3_bg_image'] ) ) : ?>background-image:url('<?php echo esc_attr( $section_info['promo_box_3_bg_image'] ); ?>')<?php endif; ?>">

				<div class="promo-box-overlay"></div>

				<div class="promo-box-inner">

					<div class="promo-box-main">
						<h4 class="promo-box-title"><?php echo do_shortcode( $section_info['promo_box_3_title'] ); ?></h4>
					</div><!-- .promo-box-main -->

				</div><!-- .promo-box-inner -->

				<?php if ( isset( $section_info['promo_box_3_url'] ) ) : ?>
					<a href="<?php echo esc_url( $section_info['promo_box_3_url'] ); ?>" class="promo-box-link"></a>
				<?php endif; ?>

			</div><!-- .promo-box -->

		<?php endif; ?>

	</div><!-- .promo-boxes -->

</div><!-- .module-wrapper -->
