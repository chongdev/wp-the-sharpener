<?php if ( wonderwall_magazine_get_theme_mod( 'footer_instagram', 'enabled' ) == 'enabled' ) : ?>

	<?php $images = wonderwall_magazine_get_instagram_images( wonderwall_magazine_get_theme_mod( 'footer_instagram_user_id', '17395902' ), 8 ); ?>

	<?php if ( $images ) : $count = 0; ?>

		<div id="footer-instagram">
			
			<?php foreach ( $images as $image ) : $count++; ?>

				<?php $image['image'] = str_replace('s150x150/', 's320x320/', $image['image'] ); ?>

				<?php if ( $count <= 8 ) : ?>

					<a href="<?php echo esc_url( $image['url'] ); ?>" target="_blank"><img src="<?php echo esc_url( $image['image'] ); ?>" alt="Instagram" /></a>

				<?php endif; ?>

			<?php endforeach; ?>

		</div><!-- #footer-instagram -->

	<?php endif; ?>

<?php endif; ?>