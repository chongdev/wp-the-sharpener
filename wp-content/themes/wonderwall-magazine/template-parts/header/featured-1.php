<?php

// vars used
$count = 0;
$real_count = 0;
$post_columns = 3;
$max_columns = 12 / $post_columns;

// post type
$post_type = array( 'post' );

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

	<div id="featured" class="featured-1">

		<div class="carousel-wrapper">

			<div class="wrapper">

				<div id="featured-1-inner">

					<div class="carousel" data-items="<?php echo esc_attr( $post_columns ); ?>" data-slide-speed="1000">

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
								$thumb_width = 394;
								$thumb_height = $thumb_width / 1;
								$mobile_thumb_height = 480 / 1;

								// column class
								$column_class = 'carousel-item col col-' . $post_columns . ' ';

								// first column
								if ( $count == 1 )
									$post_class_append = 'col-first';

								// last column
								if ( $count >= $max_columns )
									$post_class_append = 'col-last';

								// reset count on max
								if ( $count >= $max_columns )
									$count = 0;

								// post class
								$post_class = $column_class . $post_class_append;

								// set post data
								wonderwall_magazine_set_post_data( array(
									'post_class' => $post_class,
									'thumb_width' => $thumb_width,
									'mobile_thumb_height' => $mobile_thumb_height,
									'thumb_height' => $thumb_height,
								));

								// post template
								get_template_part( 'template-parts/listing/post-s2' );

							// end posts loop
							endwhile;

						?>

					</div><!-- .carousel -->

				</div><!-- #featured-1-inner -->

				<?php if ( $real_count > $max_columns ) : ?>

					<span class="carousel-nav-circle-prev"><span class="fa fa-angle-left"></span></span>
					<span class="carousel-nav-circle-next"><span class="fa fa-angle-right"></span></span>

				<?php endif; ?>

			</div><!-- .wrapper -->

		</div><!-- .carousel-wrapper -->

	</div><!-- #featured -->

<?php

// finish if statement
endif; 

// reset query
wp_reset_postdata();

?>