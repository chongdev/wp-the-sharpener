<?php

// output storage
$output_primary = '';
$output_secondary = '';

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
	'posts_per_page' => 5,
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

	// loop posts
	while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post(); $count++; $real_count++;
		
		if ( $real_count == 1 ) :

			// start output buffer
			ob_start();

			?>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
					$image_url = $image_url[0];
				?>
				<div class="featured-7-primary-thumb" style="background-image: url(<?php echo wonderwall_magazine_aq_resize( $image_url, 1980, 540, true ); ?>);"></div>
			<?php endif; ?>

			<div class="featured-7-primary-overlay"></div>
			<div class="featured-7-primary-overlay-2"></div>

			<div class="wrapper">
				
				<div class="featured-7-primary-main">

					<div class="featured-7-primary-cats"><?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?></div>

					<h2 class="featured-7-primary-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="featured-7-primary-meta"><?php wonderwall_magazine_post_meta( array( 'date' ) ); ?></div>

				</div><!-- .featured-7-primary-main -->

			</div><!-- .wrapper -->

			<?php	

			// end output buffer
			$output_primary .= ob_get_contents();
			ob_end_clean();

		else : 

			// start output buffer
			ob_start();

			?>

			<div class="featured-7-secondary-item col col-3">
				
				<div class="featured-7-secondary-thumb">
					<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( 252, 150, true, false, 460 ); ?></a>
				</div><!-- .featured-7-secondary-thumb -->

				<div class="featured-7-secondary-main">

					<div class="featured-7-secondary-cats">
						<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
					</div><!-- .posts-s2-cats -->
					
					<h2 class="featured-7-secondary-title" data-ddst-selector=".featured-7-secondary-title" data-ddst-label="Post S2 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				</div><!-- .featured-7-secondary-main -->

			</div><!-- .featured-7-secondary-item -->

			<?php	

			// end output buffer
			$output_secondary .= ob_get_contents();
			ob_end_clean();

		endif;

	// end loop posts
	endwhile;

	?>

	<div id="featured" class="featured-7">

		<div class="featured-7-primary">
			<?php echo do_shortcode( $output_primary ); ?>
		</div><!-- .featured-7-primary -->

		<div class="featured-7-secondary">
			<div class="wrapper clearfix">
				<?php echo do_shortcode( $output_secondary ); ?>
			</div><!-- .wrapper -->
		</div><!-- .featured-7-secondary -->

	</div><!-- #featured -->

<?php

// finish if statement
endif; 

// reset query
wp_reset_postdata();

?>