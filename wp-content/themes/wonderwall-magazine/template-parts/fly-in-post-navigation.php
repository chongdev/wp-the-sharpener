<?php if ( is_singular('post') && wonderwall_magazine_get_theme_mod( 'fly_in_post_navigation', 'disabled' ) == 'enabled' ) : ?>

	<?php $older_post = get_adjacent_post( false, '', true ); ?>

	<?php if ( $older_post ) : ?>
		
		<div class="fly-in-post">

			<?php if ( has_post_thumbnail( $older_post->ID ) ) : ?>
				<div class="adjacent-post-thumb">
					<?php
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $older_post->ID ), 'full' ); 
						$image_url = $image_url[0];
						$alt = wonderwall_magazine_get_attachment_alt( get_post_thumbnail_id( $older_post->ID ) ); 
						$image_src = wonderwall_magazine_aq_resize( $image_url, 600, 200, true );
					?>
					<img src="<?php echo esc_html( $image_src ); ?>" alt="" />
					<div class="adjacent-post-thumb-overlay"></div>
					<div class="adjacent-post-thumb-text"><?php esc_html_e( 'Next Post', 'wonderwall-magazine' ); ?><span class="fa fa-arrow-right"></span></div>
					<a class="adjacent-post-thumb-link" href="<?php echo get_permalink( $older_post->ID ); ?>"></a>
				</div><!-- .adjacent-post-thumb -->
			<?php endif; ?>

			<div class="adjacent-post-main">

				<h4 class="adjacent-post-title"><a href="<?php echo get_permalink( $older_post->ID ); ?>"><?php echo get_the_title( $older_post->ID ) ?></a></h4>

				<div class="adjacent-post-meta">
					<?php the_time( get_option( 'date_format' ) ); ?>
				</div><!-- .adjacent-post-meta -->

			</div><!-- .adjacent-post-main -->

		</div><!-- .fly-in-post -->

	<?php endif; ?>

<?php endif; ?>