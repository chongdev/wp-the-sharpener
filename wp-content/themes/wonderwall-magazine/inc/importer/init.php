<?php

	include get_template_directory() . '/inc/importer/ajax.php';

	function wonderwall_magazine_importer_scripts( $hook ) {

		if ( $hook == 'appearance_page_wonderwall-magazine-getting-started' ) {

			wp_enqueue_style( 'wonderwall-magazine-importer-style', get_template_directory_uri() . '/inc/importer/css/main.css', array(), '1.0' );
			wp_enqueue_script( 'wonderwall-magazine-importer-js', get_template_directory_uri() . '/inc/importer/js/main.js', array(), '1.0' );			
			wp_localize_script( 'wonderwall-magazine-importer-js', 'WonderwallMagazineImporterAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		}

	} add_action( 'admin_enqueue_scripts', 'wonderwall_magazine_importer_scripts' );

	function wonderwall_magazine_importer_notification() {

		?>

		<div class="wonderwall-magazine-importer">
			
			<div class="wonderwall-magazine-importer-inner">

				<div class="wonderwall-magazine-importer-row">
					<div class="wonderwall-magazine-importer-progress">
						<div class="wonderwall-magazine-importer-progress-item" data-wonderwall-magazine-func-name="install-nav-menus"><span>Setting up navigation menus...</span> <strong>done</strong></div>						
						<div class="wonderwall-magazine-importer-progress-item" data-wonderwall-magazine-func-name="install-home-page"><span>Setting Up Home Page...</span> <strong>done</strong></div>
						<div class="wonderwall-magazine-importer-progress-item" data-wonderwall-magazine-func-name="install-contact-page"><span>Setting Up Contact Page...</span> <strong>done</strong></div>
						<div class="wonderwall-magazine-importer-progress-item" data-wonderwall-magazine-func-name="install-blog-posts"><span>adding blog posts...</span> <strong>done</strong></div>
					</div><!-- .wonderwall-magazine-importer-progress -->
				</div><!-- .wonderwall-magazine-importer-row -->

				<div class="wonderwall-magazine-importer-all" style="clear:both;">
					<div class="wonderwall-magazine-importer-button-all">
						<a href="#" class="button button-primary wonderwall-magazine-importer-all-hook">OK, Import Demo Content</a>
					</div><!-- .wonderwall-magazine-importer-button -->
				</div><!-- .wonderwall-magazine-importer-all -->

			</div><!-- .wonderwall-magazine-importer-inner -->

		</div>

		<?php

	}