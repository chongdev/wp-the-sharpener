<?php if ( wonderwall_magazine_get_theme_mod( 'prev_next_posts', 'enabled' ) == 'enabled' ) : ?>

	<?php
		
		// get prev and next posts
		$older_post = get_adjacent_post( false, '', true );
		$newer_post = get_adjacent_post( false, '', false );

	?>
	<div class="adjacent-posts clearfix">
		
		<div class="adjacent-post adjacent-post-newer col col-6">
			
			<?php if ( $newer_post ) : ?>
				
				<?php if ( has_post_thumbnail( $newer_post->ID ) ) : ?>
					<div class="adjacent-post-thumb">
						<?php
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $newer_post->ID ), 'full' ); 
							$image_url = $image_url[0];
							$alt = wonderwall_magazine_get_attachment_alt( get_post_thumbnail_id( $newer_post->ID ) ); 
							$image_src = wonderwall_magazine_aq_resize( $image_url, 600, 200, true );
						?>
						<img src="<?php echo esc_html( $image_src ); ?>" alt="" />
						<div class="adjacent-post-thumb-overlay"></div>
						<div class="adjacent-post-thumb-text"><span class="fa fa-arrow-left"></span><?php esc_html_e( 'Previous Post', 'wonderwall-magazine' ); ?></div>
						<a class="adjacent-post-thumb-link" href="<?php echo get_permalink( $newer_post->ID ); ?>"></a>
					</div><!-- .adjacent-post-thumb -->
				<?php endif; ?>

				<div class="adjacent-post-main">

					<h4 class="adjacent-post-title"><a href="<?php echo get_permalink( $newer_post->ID ); ?>"><?php echo get_the_title( $newer_post->ID ) ?></a></h4>

					<div class="adjacent-post-meta">
						<?php the_time( get_option( 'date_format' ) ); ?>
					</div><!-- .adjacent-post-meta -->

				</div><!-- .adjacent-post-main -->

			<?php else: ?>
				
				<div class="adjacent-post-none">
					<div class="adjacent-post-none-text"><?php esc_html_e( 'No Previous Post', 'wonderwall-magazine' ); ?></div>
				</div><!-- .adjacent-post-none -->

			<?php endif; ?>

		</div><!-- .adjacent-post-newer -->
		
		<div class="adjacent-post adjacent-post-older col col-6 col-last">
			
			<?php if ( $older_post ) : ?>
				
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

			<?php else : ?>

				<div class="adjacent-post-none">
					<div class="adjacent-post-none-text"><?php esc_html_e( 'No More Posts', 'wonderwall-magazine' ); ?></div>
				</div><!-- .adjacent-post-none -->

			<?php endif; ?>

		</div><!-- .adjacent-post-newer -->

	</div><!-- .adjacent-posts -->

<?php endif; ?>