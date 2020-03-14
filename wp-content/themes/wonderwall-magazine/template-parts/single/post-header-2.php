<?php
	// the layout
	$layout = 'right_sidebar';
	if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'layout' ) ) {
		$layout = wonderwall_magazine_get_post_meta( get_the_ID(), 'layout' );
	}

	// thumb width
	$thumb_width = 723;
	if ( $layout == 'no_sidebar' ) {
		$thumb_width = 1100;
	}

	// default featured image
	$default_featured_image = wonderwall_magazine_get_theme_mod( 'post_featured_image', false );	

?>
<div class="blog-post-single-header blog-post-single-header-2">
	
	<div class="blog-post-single-thumb">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php wonderwall_magazine_the_post_thumbnail( $thumb_width, 99999, false, false, 430 ); ?>
		<?php elseif ( $default_featured_image ) : ?>
			<img src="<?php echo wonderwall_magazine_aq_resize( $default_featured_image, $thumb_width, 99999, false ); ?>" alt="" />
		<?php endif; ?>
	</div><!-- .blog-post-single-thumb -->

	<div class="blog-post-single-header-overlay"></div>

	<div class="blog-post-single-header-main">

		<div class="blog-post-single-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
		</div><!-- .blog-post-single-cats -->

		<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

		<div class="blog-post-single-meta">
			<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'views' ), 'clean' ); ?>
		</div><!-- .blog-post-single-meta -->

	</div><!-- .blog-post-single-header-main -->

</div><!-- .blog-post-single-header -->