<?php

// vars used
$count = 0;
$real_count = 0;
$post_columns = 6;
$max_columns = 12 / $post_columns;

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

	<div id="featured" class="featured-2">

		<div class="carousel-wrapper">

			<div class="carousel no-col-spacing" data-items="1">

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
						$thumb_width = 2000;
						$thumb_height = $thumb_width / 4.05;
						$mobile_thumb_height = 480 / 1;

						// column class
						$column_class = 'col col-' . $post_columns . ' carousel-item post-s4-center ';

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
							'mobile_thumb_width' => $mobile_thumb_height,
							'thumb_height' => $thumb_height,
						));

						// post template
						get_template_part( 'template-parts/listing/post-s4' );

					// end posts loop
					endwhile; 

				?>

			</div><!-- .carousel -->			

			<?php if ( $real_count > 1 ) : ?>
				<span class="carousel-nav-overlay-prev carousel-nav-trigger-prev-animate"><span class="fa fa-angle-left"></span></span>
				<span class="carousel-nav-overlay-next carousel-nav-trigger-next-animate"><span class="fa fa-angle-right"></span></span>
			<?php endif; ?>

		</div><!-- .carousel-container -->

	</div><!-- #featured -->

<?php

// Finish if statement
endif; 

// Reset query
wp_reset_postdata();

?>