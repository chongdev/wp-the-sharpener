<?php

	// gallery
	$gallery = false;
	if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'gallery' ) ) {
		$gallery = wonderwall_magazine_get_post_meta( get_the_ID(), 'gallery' );
	}

	// default featured image
	$default_featured_image = wonderwall_magazine_get_theme_mod( 'post_featured_image', false );	

?>
<div class="blog-post-single-header blog-post-single-header-4">
	
	<div class="wrapper">

		<div class="blog-post-single-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
		</div><!-- .blog-post-single-cats -->

		<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

		<div class="blog-post-single-meta">
			<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'views' ), 'clean' ); ?>
		</div><!-- .blog-post-single-meta -->

		<?php if ( $video = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ) ) : ?>
			<div class="blog-post-single-thumb">
				<?php echo wp_oembed_get( $video ); ?>
			</div><!-- .blog-post-single-thumb -->
		<?php elseif ( $gallery ) : ?>
			<div class="blog-post-single-gallery gallery-carousel-wrapper">
				<div class="gallery-carousel">
					<?php foreach ( $gallery as $gallery_image ) : ?>
						<div class="blog-post-single-gallery-item carousel-item">
							<img src="<?php echo esc_url( $gallery_image ); ?>" alt="" ?>
						</div><!-- .blog-post-single-gallery-item -->
					<?php endforeach; ?>
				</div><!-- .gallery-carousel -->
				<span class="gallery-carousel-nav-circle-prev gallery-carousel-nav-trigger-prev"><span class="fa fa-angle-left"></span></span>
				<span class="gallery-carousel-nav-circle-next gallery-carousel-nav-trigger-next"><span class="fa fa-angle-right"></span></span>
			</div><!-- .blog-post-single-gallery -->
		<?php else : ?>
			<div class="blog-post-single-thumb">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php wonderwall_magazine_the_post_thumbnail( 1100, 99999, false, false, 430 ); ?>
				<?php elseif ( $default_featured_image ) : ?>
					<img src="<?php echo wonderwall_magazine_aq_resize( $default_featured_image, 1100, 99999, false ); ?>" alt="" />
				<?php endif; ?>
			</div><!-- .blog-post-single-thumb -->
		<?php endif; ?>

	</div><!-- .wrapper -->

</div><!-- .blog-post-single-header -->