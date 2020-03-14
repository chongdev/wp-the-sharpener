<div class="share-post-wrapper">
	
	<h2 class="section-title" data-ddst-selector=".section-title span" data-ddst-label="Section Title"><span><?php esc_html_e( 'Share this post', 'wonderwall-magazine' ); ?></span></h2>

	<div class="share-post">

		<div class="share-post-count">
			<?php $share_info = wonderwall_magazine_get_social_count(); ?>
			<span class="share-post-count-num"><?php echo esc_html( $share_info['total'] ); ?></span>
			<span class="share-post-count-text"><?php esc_html_e( 'shares', 'wonderwall-magazine' ); ?></span>
		</div><!-- .share-posot-count -->

		<div class="share-post-links">
			<?php wonderwall_magazine_social_share_links( get_the_ID() ); ?>
		</div><!-- .share-post-links -->

	</div><!-- .share-post -->

</div><!-- .share-post-wrapper -->