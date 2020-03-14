<?php
	// the layout
	$layout = 'right_sidebar';
	if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'layout' ) ) {
		$layout = wonderwall_magazine_get_post_meta( get_the_ID(), 'layout' );
	}

	// thumb width
	$thumb_width = 719;
	if ( $layout == 'no_sidebar' ) {
		$thumb_width = 1100;
	}

	// gallery
	$gallery = false;
	if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'gallery' ) ) {
		$gallery = wonderwall_magazine_get_post_meta( get_the_ID(), 'gallery' );
	}

	// default featured image
	$default_featured_image = wonderwall_magazine_get_theme_mod( 'post_featured_image', false );	

?>
<div class="blog-post-single-header blog-post-single-header-1">
	
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
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="blog-post-single-thumb">
				<?php wonderwall_magazine_the_post_thumbnail( $thumb_width, 99999, false, false, 430 ); ?>
			</div><!-- .blog-post-single-thumb -->
		<?php elseif ( $default_featured_image ) : ?>
			<div class="blog-post-single-thumb">
				<img src="<?php echo wonderwall_magazine_aq_resize( $default_featured_image, $thumb_width, 99999, false ); ?>" alt="" />
			</div><!-- .blog-post-single-thumb -->
		<?php endif; ?>
	<?php endif; ?>
	
	<div class="blog-post-single-cats">
		<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
	</div><!-- .blog-post-single-cats -->

	<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

	<div class="blog-post-single-meta">
		<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'views' ), 'clean' ); ?>
	</div><!-- .blog-post-single-meta -->

</div><!-- .blog-post-single-header -->