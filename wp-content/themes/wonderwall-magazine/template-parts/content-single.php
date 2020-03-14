<?php
	/* Outputs on a single blog post page */
?>

<?php
	// get global style
	$style = wonderwall_magazine_get_theme_mod( 'post_style', 'v1' );

	// get local style
	$local_style = false;
	if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'post_style' ) ) {
		$local_style = wonderwall_magazine_get_post_meta( get_the_ID(), 'post_style' );
	}

	// get style
	if ( $local_style && $local_style != 'default' ) {
		$style = $local_style;
	}

	if ( $style == 'v1' ) {
		get_template_part( 'template-parts/single/post-header-1' );
	} elseif ( $style == 'v2' ) {
		get_template_part( 'template-parts/single/post-header-2' );
	} elseif ( $style == 'v3' ) {
		// output elsewhere ( header.php )
	} elseif ( $style == 'v4' ) {
		// output elsewhere ( header.php )
	} else {
		get_template_part( 'template-parts/single/post-header-1' );
	}

?>

<div class="blog-post-single-main">

	<div class="blog-post-single-content">
		<?php the_content(); ?>
	</div><!-- .blog-post-single-content -->

	<?php if ( has_tag() && wonderwall_magazine_get_theme_mod( 'post_single_tags', 'enabled' ) == 'enabled' ) : ?>
		<div class="blog-post-single-tags">
			<span class="blog-post-single-tags-label"><?php esc_html_e( 'Tags:', 'wonderwall-magazine' ); ?></span>
			<?php the_tags( '', ' ', '' ); ?>
		</div><!-- .blog-post-single-tags -->
	<?php endif; ?>

	<div class="blog-post-single-link-pages">
		<?php wp_link_pages(); ?>
	</div><!-- .blog-post-single-link-pages -->

	<?php if ( wonderwall_magazine_get_theme_mod( 'social_sharing', 'enabled' ) == 'enabled' || wonderwall_magazine_get_theme_mod( 'social_sharing', 'enabled' ) == 'enabled_addthis' ) : ?>

		<?php
			// vars
			$post_permalink = get_permalink( get_the_ID() );
			$post_title = str_replace( '&#038;', '', get_the_title( get_the_ID() ) );
			$post_img = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			$count = wonderwall_magazine_get_social_count( get_the_ID() );
			$twitter_share_append = '';
			if ( $twitter_username = wonderwall_magazine_get_theme_mod( 'social_twitter_username' ) ) {
				$twitter_share_append = ' by @' . $twitter_username;
			}
		?>

		<div class="blog-post-single-share">

			<div class="post-share-aside-count">
				<span class="post-share-aside-count-num"><?php echo esc_html( $count['total'] ); ?></span>
				<span class="post-share-aside-count-text"><?php esc_html_e( 'shares', 'wonderwall-magazine' ); ?></span>
			</div><!-- .post-share-aside-count -->

			<?php if ( wonderwall_magazine_get_theme_mod( 'social_sharing', 'enabled' ) == 'enabled_addthis' ) : ?>
				<?php do_action( 'addthis_widget', get_permalink(), get_the_title(), 'above' ); ?>
			<?php else : ?>
				<a href="#" class="post-share-aside-share post-share-aside-share-facebook" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'http://www.facebook.com/share.php?u=<?php echo esc_html( $post_permalink ); ?>')"><span class="inactive fa fa-facebook"></span><span class="active fa fa-share"></span></a>
				<a href="#" class="post-share-aside-share post-share-aside-share-pinterest" target="_blank"  onClick="return wonderwall_magazine_social_share(400, 300, 'https://pinterest.com/pin/create/button/?url=<?php echo esc_html( $post_permalink ); ?>&amp;media=<?php echo esc_html( $post_img ); ?>')"><span class="inactive fa fa-pinterest"></span><span class="active fa fa-share"></span></a>
				<a href="#" class="post-share-aside-share post-share-aside-share-twitter"  target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'https://twitter.com/home?status=<?php echo esc_attr( $post_title . ' ' . $post_permalink . $twitter_share_append ); ?>')"><span class="inactive fa fa-twitter"></span><span class="active fa fa-share"></span></a>
				<a class="post-share-aside-share post-share-aside-share-email" href="mailto:someone@example.com?subject=<?php echo rawurlencode( $post_title ); ?>&amp;body=<?php echo rawurlencode( $post_title . ' ' . $post_permalink ); ?>"><span class="inactive fa fa-envelope"></span><span class="active fa fa-share"></span></a>
			<?php endif; ?>
		</div><!-- .blog-post-single-share -->

	<?php endif; ?>

</div><!-- .blog-post-single-main -->

<span class="wonderwall-magazine-count-views" data-post-id="<?php the_ID(); ?>">