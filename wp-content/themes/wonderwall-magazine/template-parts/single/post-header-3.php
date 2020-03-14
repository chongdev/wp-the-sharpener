<?php
	// default featured image
	$default_featured_image = wonderwall_magazine_get_theme_mod( 'post_featured_image', false );	
?>
<div class="blog-post-single-header blog-post-single-header-3">
		
	<div class="blog-post-single-thumb">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php wonderwall_magazine_the_post_thumbnail( 1980, 450, true, 800, 600, true ); ?>
		<?php elseif ( $default_featured_image ) : ?>
			<img src="<?php echo wonderwall_magazine_aq_resize( $default_featured_image, 1980, 450, true ); ?>" alt="" />
		<?php endif; ?>
	</div><!-- .blog-post-single-thumb -->

	<div class="blog-post-single-header-overlay"></div>

	<div class="blog-post-single-header-main">

		<div class="wrapper">

			<div class="blog-post-single-cats">
				<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
			</div><!-- .blog-post-single-cats -->

			<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

			<div class="blog-post-single-meta">
				<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'views' ), 'clean' ); ?>
			</div><!-- .blog-post-single-meta -->

		</div><!-- .wrapper -->

	</div><!-- .blog-post-single-header-main -->

</div><!-- .blog-post-single-header -->