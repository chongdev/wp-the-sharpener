<?php

/**
 * featured slides
 */

// HTML will be stored here
$slider_featured_posts = '';

// tag to show
$tag_to_show = 'featured-small';

// query args
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 2,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field'    => 'slug',
			'terms'    => $tag_to_show,
		),
	),
);

// query posts
$wonderwall_magazine_query = new WP_Query( $args );

// if there are posts
if ( $wonderwall_magazine_query->have_posts() ) : 

	// count
	$count = 0;

	// start output buffer
	ob_start();
	
	?>
	<div class="featured-item-left-secondary clearfix">

		<div class="wrapper clearfix">

			<div class="col col-6">
							
				<span class="featured-item-left-secondary-txt"><?php esc_html_e( 'Featured Articles', 'wonderwall-magazine' ); ?></span>

				<?php while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post(); $count++; ?>

					<div class="featured-secondary-item col col-6 <?php if ( $count == 2 ) echo esc_attr( 'col-last' ); ?>">

						<div class="featured-secondary-thumbnail">
							<?php wonderwall_magazine_the_post_thumbnail( 296, 165, true, false, false ); ?>
						</div><!-- .featured-secondary-thumbnail -->

						<div class="featured-secondary-main">

							<div class="featured-secondary-meta"><?php wonderwall_magazine_post_meta( array( 'date' ), 'clean' ); ?></div>
							<h4 class="featured-secondary-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

						</div><!-- .featured-secondary-main -->

					</div><!-- .featured-secondary-item -->

				<?php endwhile; ?>

			</div><!-- .col -->

		</div><!-- .wrapper -->

	</div><!-- .featured-item-left-secondary -->

	<?php

	// end output buffer
	$slider_featured_posts = ob_get_contents();
	ob_end_clean();

// end if there are posts
endif; 

// reset query
wp_reset_postdata();

/**
 * regular slides
 */

// tag to show
$tag_to_show = 'featured';
if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_tag' ) ) {
	$tag_to_show = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_tag' );
}

// query args
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 20,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field'    => 'slug',
			'terms'    => $tag_to_show,
		),
	),
);

// query posts
$wonderwall_magazine_query = new WP_Query( $args );

// if there are posts
if ( $wonderwall_magazine_query->have_posts() ) : 

	?>

	<div class="featured">

		<div class="carousel-wrapper">

				<div class="carousel" data-items="1" data-transition-style="fade">

					<?php

						// start posts loop
						while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post();
							
							// holds the HTML
							$featured_item_left = '';
							$featured_item_right = '';

							/**
							 * generate right section
							 */

							// start output buffer
							ob_start();

							// get thumbnail
							wonderwall_magazine_the_post_thumbnail( 609, 720, true, false, false );

							// end output buffer
							$featured_item_right = ob_get_contents();
							ob_end_clean();

							/**
							 * generate left section
							 */

							// start output buffer
							ob_start();

							?>

							<div class="featured-item-left-primary">
								
								<div class="featured-item-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
								<div class="featured-item-date-alt">
									<span><?php the_time( 'd' ); ?></span>
									<span>-</span>
									<span><?php the_time( 'm' ); ?></span>
								</div><!-- .featured-item-date-alt -->
								<h2 class="featured-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<a href="<?php the_permalink(); ?>" class="featured-item-read-more"><?php esc_html_e( 'Read Article', 'wonderwall-magazine' ); ?></a>

							</div><!-- .featured-item-left-primary -->

							<?php

							// end output buffer
							$featured_item_left = ob_get_contents();
							ob_end_clean();

							?>

							<div class="carousel-item featured-item">

								<div class="wrapper">

									<div class="featured-item-left col col-6">
										<?php echo do_shortcode( $featured_item_left ); ?>
									</div><!-- .featured-item-left -->

									<div class="featured-item-right col col-6 col-last">
										<?php echo do_shortcode( $featured_item_right ); ?>
									</div><!-- .featured-item-right -->

								</div><!-- .wrapper -->

							</div><!-- .carousel-item -->

							<?php

						// end posts loop
						endwhile;

					?>

				</div><!-- .carousel -->

				<?php echo do_shortcode( $slider_featured_posts ); ?>

				<span class="featured-nav-prev">
					<span class="featured-nav-image"></span>
					<span class="featured-nav-arrow"><span class="fa fa-angle-left"></span></span>
				</span><!-- .featured-nav-prev -->
				<span class="featured-nav-next">
					<span class="featured-nav-image"></span>
					<span class="featured-nav-arrow"><span class="fa fa-angle-right"></span></span>
				</span><!-- .featured-nav-next -->

		</div><!-- .carousel-wrapper -->

	</div><!-- #featured -->

<?php

// finish if statement
endif; 

// reset query
wp_reset_postdata();

?>