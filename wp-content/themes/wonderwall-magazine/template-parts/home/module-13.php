<?php

// section info
$section_info = wonderwall_magazine_get_section_info();

// amount of posts
$posts_per_page = 4;
if ( isset( $section_info['posts_per_page'] ) && is_numeric( $section_info['posts_per_page'] ) ) {
	$posts_per_page = $section_info['posts_per_page'];
}

// vars used
$count = 0;
$real_count = 0;
$post_columns = 3;
$max_columns = 12 / $post_columns;

// current page
if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }

// query arguments
$args = array(
	'post_type' => 'post',
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'orderby' => $section_info['post_orderby'],
	'order' => $section_info['post_order'],
	'no_found_rows' => true,
);

// blog categories
if ( isset( $section_info['blog_categories'] ) && is_array( $section_info['blog_categories'] ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $section_info['blog_categories'],
	);
}

// exclude tags
if ( isset( $section_info['blog_exclude_tags'] ) && $section_info['blog_exclude_tags'] !== '' ) {

	if ( isset( $args['tax_query'] ) ) {
		$args['tax_query']['relation'] = 'AND';
	}

	$exclude_tags = explode( ' ', $section_info['blog_exclude_tags'] );
	$args['tax_query'][] = array(
		'taxonomy' => 'post_tag',
		'field'    => 'slug',
		'terms'    => $exclude_tags,
		'operator' => 'NOT IN',
	);

}

// do the query
$wonderwall_magazine_query = new WP_Query( $args );

// if there are posts
if ( $wonderwall_magazine_query->have_posts() ) :

?>

	<div class="module-wrapper module-13-wrapper <?php if ( $section_info['spacing'] == 'enabled' ) echo 'module-with-spacing'; ?>">

		<div class="wrapper">

			<?php if ( isset( $section_info['section_title'] ) ) : ?>
				<?php wonderwall_magazine_section_title( $section_info['section_title'], false, $section_info['section_title_url'] ); ?>
			<?php endif; ?>
			
			<div class="module-13 clearfix">

				<div class="module-posts-listing">

					<div class="module-posts-listing-inner clearfix">

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
								$thumb_width = 252;
								$thumb_height = $thumb_width / 1.66;
								$mobile_thumb_height = 480 / 1.66;

								// column class
								$column_class = 'col col-' . $post_columns . ' ';

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

					</div><!-- .module-posts-listing-inner -->						

				</div><!-- .module-posts-listing -->

			</div><!-- .module-13 -->

		</div><!-- .wrapper -->

	</div><!-- module-13-wrapper -->

<?php

// end if there are posts
endif;

// reset query
wp_reset_postdata();