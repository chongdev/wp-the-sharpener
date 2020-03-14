<?php

$primary_output_1 = '';
$primary_output_2 = '';
$mobile_output = '';

// vars used
$count = 0;
$real_count = 0;
$post_columns = 12;
$max_columns = 12 / $post_columns;

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

	<div id="featured" class="featured-6">

		<div class="carousel-wrapper">

			<div class="wrapper">

				<div class="carousel no-col-spacing" data-items="1" data-spacing="2">

					<?php 

						// start posts loop
						while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post();

							// reset vars
							$post_class_append = '';
							$column_class = '';

							// increase counts
							$count++;
							$real_count++;

							// thumbnail sizes
							$thumb_width = 1100;
							$thumb_height = $thumb_width / 2;
							$mobile_thumb_width = 480;
							$mobile_thumb_height = 480 / 1.8;

							// column class
							$column_class = 'col col-' . $post_columns . ' carousel-item clearfix ';

							// first column
							if ( $count == 1 )
								$post_class_append = 'col-first';

							// last column
							if ( $count >= $max_columns )
								$post_class_append = 'col-last';

							// post class
							$post_class = $column_class . $post_class_append;

							// first item
							if ( $count == 1 ) {

								// thumbnail sizes
								$thumb_width = 548;
								$thumb_height = $thumb_width / 1;
								$mobile_thumb_height = 480;

								// start output buffer
								ob_start();

								// set post data
								wonderwall_magazine_set_post_data( array(
									'post_class' => $post_class,
									'thumb_width' => $thumb_width,
									'mobile_thumb_height' => $mobile_thumb_height,
									'mobile_thumb_width' => $mobile_thumb_height,
									'thumb_height' => $thumb_height,
								));

								// post template
								get_template_part( 'template-parts/listing/post-s4' );

								// end output buffer
								$ob_output = ob_get_contents();
								$mobile_output .= $ob_output;
								$primary_output_1 .= $ob_output;
								ob_end_clean();

							// second and third
							} elseif ( $count == 2 || $count == 3 ) {

								// thumbnail sizes
								$thumb_width = 548;
								$thumb_height = $thumb_width / 2;
								$mobile_thumb_height = 480;

								// start output buffer
								ob_start();

								// set post data
								wonderwall_magazine_set_post_data( array(
									'post_class' => $post_class,
									'thumb_width' => $thumb_width,
									'mobile_thumb_height' => $mobile_thumb_height,
									'mobile_thumb_width' => $mobile_thumb_height,
									'thumb_height' => $thumb_height,
								));

								// post template
								get_template_part( 'template-parts/listing/post-s4' );

								// end output buffer
								$ob_output = ob_get_contents();
								$mobile_output .= $ob_output;
								$primary_output_2 .= $ob_output;
								ob_end_clean();

							}

							if ( $count == 3 ) {

								?>
								<div class="carousel-item featured-6-primary clearfix">
									<div class="col col-6 featured-6-primary-1">
										<?php echo do_shortcode( $primary_output_1 ); ?>
									</div><!-- .col-6 -->
									<div class="col col-6 col-last featured-6-primary-2">
										<?php echo do_shortcode( $primary_output_2 ); ?>
									</div><!-- col-6 -->
								</div><!-- .caroseul-item -->
								<?php

								$primary_output_1 = '';
								$primary_output_2 = '';

							}

							// reset count on max
							if ( $count >= 3 )
								$count = 0;

						// end posts loop
						endwhile; 

					?>

				</div><!-- .carousel -->

				<span class="carousel-nav-overlay-prev carousel-nav-trigger-prev"></span>
				<span class="carousel-nav-overlay-next carousel-nav-trigger-next"></span>

			</div><!-- .wrapper -->

		</div><!-- .carousel-container -->

	</div><!-- #featured -->

	<div id="featured-mobile" class="featured-mobile-6">
		<div class="carousel no-col-spacing" data-items="1">
			<?php echo do_shortcode( $mobile_output ); ?>
		</div><!-- .carousel -->
	</div><!-- #featured-mobile -->

<?php

// Finish if statement
endif; 

// Reset query
wp_reset_postdata();

?>