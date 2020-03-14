<div id="top-bar" data-ddst-selector="#top-bar" data-ddst-label="Top Bar" data-ddst-no-support="typography,border">
	
	<div class="wrapper clearfix">

		<div id="top-bar-navigation"  data-ddst-selector="#top-bar-navigation .menu > li > a" data-ddst-label="Navigation Items" data-ddst-no-support="background,border">
			<?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'menu_id' => 'top-bar-menu', 'fallback_cb' => false ) ); ?>
		</div><!-- #top-bar-navigation -->

		<div id="top-bar-social-search">

			<div id="top-bar-social" class="clearfix" data-ddst-selector="#top-bar-social a" data-ddst-label="Top Bar - Social" data-ddst-no-support="background,border">
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_twitter', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_twitter', false ) ); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_facebook', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_facebook', false ) ); ?>" target="_blank"><span class="fa fa-facebook"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_youtube', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_youtube', false ) ); ?>" target="_blank"><span class="fa fa-youtube"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_vimeo', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_vimeo', false ) ); ?>" target="_blank"><span class="fa fa-vimeo"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_tumblr', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_tumblr', false ) ); ?>" target="_blank"><span class="fa fa-tumblr"></span></a>					
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_pinterest', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_pinterest', false ) ); ?>" target="_blank"><span class="fa fa-pinterest"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_linkedin', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_linkedin', false ) ); ?>" target="_blank"><span class="fa fa-linkedin"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_instagram', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_instagram', false ) ); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_github', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_github', false ) ); ?>" target="_blank"><span class="fa fa-github"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_googleplus', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_googleplus', false ) ); ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_dribbble', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_dribbble', false ) ); ?>" target="_blank"><span class="fa fa-dribbble"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_dropbox', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_dropbox', false ) ); ?>" target="_blank"><span class="fa fa-dropbox"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_flickr', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_flickr', false ) ); ?>" target="_blank"><span class="fa fa-flickr"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_foursquare', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_foursquare', false ) ); ?>" target="_blank"><span class="fa fa-foursquare"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_behance', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_behance', false ) ); ?>" target="_blank"><span class="fa fa-behance"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_vine', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_vine', false ) ); ?>" target="_blank"><span class="fa fa-vine"></span></a>
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_rss', false ) ) : ?>
					<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_rss', false ) ); ?>" target="_blank"><span class="fa fa-rss"></span></a>
				<?php endif; ?>
			</div><!-- #top-bar-social -->

			<div id="top-bar-search" class="search-overlay-open" data-ddst-selector="#top-bar-search" data-ddst-label="Top Bar Search" data-ddst-no-support="">
				<span class="fa fa-search"></span>
			</div><!-- #top-bar-search -->

		</div><!-- #top-bar-social-search -->

	</div><!-- .wrapper -->

</div><!-- #top-bar -->