<?php
	/* Outputs on a single blog post page */
?>
<div class="blog-post-single-slideshow">

	<div class="blog-post-single-slideshow-meta">
		<div class="post-meta-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
		<div class="blog-post-single-slideshow-meta-author"><span><?php echo esc_html_e( 'by', 'wonderwall-magazine' ); ?></span><?php the_author_posts_link(); ?></div>
	</div><!-- .blog-post-single-slideshow-meta -->

	<div class="blog-post-single-slideshow-top">
		<h1 class="blog-post-single-slideshow-title"><?php the_title(); ?></h1>
		<div class="blog-post-single-slideshow-share">
			<?php get_template_part( 'template-parts/main/share-post' ); ?>
		</div><!-- .blog-post-single-slideshow-share -->
	</div><!-- .blog-post-single-slide-show-top -->

	<div class="blog-post-single-slideshow-main">

		<div class="carousel-wrapper">

			<div class="carousel" data-items="1" data-transition-style="fade">

				<?php 

					$slideshow = wonderwall_magazine_get_post_meta( get_the_ID(), 'slideshow' );
					$count = 0;
					$total_count = count( $slideshow );
					foreach ( $slideshow as $slideshow_item ) : $count++;
						?>
						<div class="carousel-item blog-post-single-slideshow-item clearfix">

							<div class="blog-post-single-slideshow-item-main col col-4">
								
								<div class="blog-post-single-slideshow-content">
									<?php echo do_shortcode( $slideshow_item['content'] ); ?>
								</div><!-- .blog-post-single-slideshow-content -->
								
								<div class="blog-post-single-slideshow-nav">
									<span class="blog-post-single-slideshow-nav-count">
										<?php echo esc_html( $count ); ?> / <?php echo esc_html( $total_count ); ?>
									</span>
									<span class="carousel-nav-trigger-prev"><span class="fa fa-angle-left"></span></span>
									<span class="carousel-nav-trigger-next"><span class="fa fa-angle-right"></span></span>
								</div><!-- blog-post-single-slideshow-nav -->

							</div><!-- .blog-post-single-slideshow-item-main -->

							<div class="blog-post-single-slideshow-item-image col col-8 col-last">
								<img src="<?php echo esc_url( $slideshow_item['image'] ); ?>">
							</div><!-- .blog-post-single-slideshow-item-image -->

						</div><!-- .blog-post-single-slideshow-item -->
						<?php
					endforeach;

				?>

			</div><!-- .carousel -->

		</div><!-- .carousel-wrapper -->

	</div><!-- .blog-post-single-slideshow-main -->

</div><!-- .blog-post-slideshow -->