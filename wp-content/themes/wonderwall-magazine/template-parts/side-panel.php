<?php
	// user defined logo image
	$logo_img_src = wonderwall_magazine_get_theme_mod( 'logo_panel', false );

	// logo image class
	$logo_img_class = '';
?>

<div id="panel-overlay"></div>

<div id="panel">

	<div id="panel-inner">

		<div id="panel-logo">
			<span id="panel-close"><span class="fa fa-close"></span></span>
			<?php if ( ! $logo_img_src ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_bloginfo(); ?></a>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="<?php echo esc_attr( $logo_img_class );?>" src="<?php echo esc_attr( $logo_img_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
			<?php endif; ?>
		</div><!-- #panel-logo -->

		<div id="panel-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'panel', 'menu_id' => 'panel-menu', 'fallback_cb' => false ) ); ?>
		</div><!-- #panel-navigation -->

		<div id="panel-social">
			<div class="social-widget">
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_twitter', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-twitter" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_twitter', false ) ); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_facebook', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-facebook" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_facebook', false ) ); ?>" target="_blank"><span class="fa fa-facebook"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_youtube', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-youtube" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_youtube', false ) ); ?>" target="_blank"><span class="fa fa-youtube-play"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_vimeo', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-vimeo" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_vimeo', false ) ); ?>" target="_blank"><span class="fa fa-vimeo"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_tumblr', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-tumblr" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_tumblr', false ) ); ?>" target="_blank"><span class="fa fa-tumblr"></span></a>					
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_pinterest', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-pinterest" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_pinterest', false ) ); ?>" target="_blank"><span class="fa fa-pinterest"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_linkedin', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-linkedin" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_linkedin', false ) ); ?>" target="_blank"><span class="fa fa-linkedin"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_instagram', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-instagram" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_instagram', false ) ); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_github', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-github" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_github', false ) ); ?>" target="_blank"><span class="fa fa-github"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_googleplus', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-googleplus" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_googleplus', false ) ); ?>" target="_blank"><span class="fa fa-googleplus"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_dribbble', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-dribbble" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_dribbble', false ) ); ?>" target="_blank"><span class="fa fa-dribbble"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_dropbox', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-dropbox" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_dropbox', false ) ); ?>" target="_blank"><span class="fa fa-dropbox"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_flickr', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-flickr" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_flickr', false ) ); ?>" target="_blank"><span class="fa fa-flickr"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_foursquare', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-foursquare" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_foursquare', false ) ); ?>" target="_blank"><span class="fa fa-foursquare"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_behance', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-behance" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_behance', false ) ); ?>" target="_blank"><span class="fa fa-behance"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_vine', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-vine" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_vine', false ) ); ?>" target="_blank"><span class="fa fa-vine"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_rss', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link">
						<span class="social-widget-link-outline"></span>
						<a class="social-link-rss" href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_rss', false ) ); ?>" target="_blank"><span class="fa fa-rss"></span></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
			</div><!-- .social-widget -->

		</div><!-- #panel-social -->

	</div><!-- #panel-inner -->

</div><!-- #panel -->