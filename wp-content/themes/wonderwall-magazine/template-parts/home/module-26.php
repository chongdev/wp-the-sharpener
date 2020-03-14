<?php

// section info
$section_info = wonderwall_magazine_get_section_info();

if ( ! isset( $section_info['pagination'] ) ) {
	$section_info['pagination'] = 'disabled';
}

// amount of posts
$posts_per_page = 6;
if ( isset( $section_info['posts_per_page'] ) && is_numeric( $section_info['posts_per_page'] ) ) {
	$posts_per_page = $section_info['posts_per_page'];
}

// vars used
$count = 0;
$real_count = 0;
$post_columns = 6;
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

	// amount of pages
	$num_pages = $wonderwall_magazine_query->max_num_pages;

?>

	<div class="module-wrapper module-26-wrapper <?php if ( $section_info['spacing'] == 'enabled' ) echo 'module-with-spacing'; ?>">

		<div class="wrapper clearfix">

			<div class="module-26 col col-8">

				<?php if ( isset( $section_info['section_title'] ) ) : ?>
					<?php wonderwall_magazine_section_title( $section_info['section_title'], false, $section_info['section_title_url'] ); ?>
				<?php endif; ?>

				<div class="module-posts-listing module-26-posts-listing" data-id="module-26-posts-listing">

					<div class="module-posts-listing-inner masonry-init clearfix">

						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>

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
								$thumb_width = 346;
								$thumb_height = $thumb_width / 0.88;
								$mobile_thumb_height = 480 / 1.56;

								// column class
								$column_class = 'col col-' . $post_columns . ' masonry-item ';

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

								// post template
								if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'm_25_26_style', true ) == 'text_inside_thumb' ) {
									
									// set post data
									wonderwall_magazine_set_post_data( array(
										'post_class' => $post_class,
										'thumb_width' => $thumb_width,
										'mobile_thumb_height' => $mobile_thumb_height,
										'thumb_height' => $thumb_height,
									));

									// post template
									get_template_part( 'template-parts/listing/post-s4' );

								} else {
									$thumb_height = 99999;
									
									// set post data
									wonderwall_magazine_set_post_data( array(
										'post_class' => $post_class,
										'thumb_width' => $thumb_width,
										'mobile_thumb_height' => $mobile_thumb_height,
										'thumb_height' => $thumb_height,
									));

									// post template
									get_template_part( 'template-parts/listing/post-s1' );

								}

							// end posts loop
							endwhile;

						?>

					</div><!-- .module-posts-listing-inner -->

					<?php
						// ajax pagination
						if ( $section_info['pagination'] == 'enabled' ) {
							wonderwall_magazine_posts_pagination( array( 'pages' => $num_pages ) );
						}

						// classic pagination
						if ( $section_info['pagination'] == 'enabled_classic' ) {
							wonderwall_magazine_posts_pagination( array( 'type' => 'classic', 'pages' => $num_pages ) );
						}
					?>

				</div><!-- .module-posts-listing -->

			</div><!-- .module-26 -->

			<?php if ( is_active_sidebar( 'sidebar-m-26' ) ) : ?>
				<div class="sidebar col col-4 col-last sticky-sidebar-<?php echo esc_attr( $section_info['sticky_sidebar'] ); ?>">
					<?php dynamic_sidebar( 'sidebar-m-26' ); ?>
				</div><!-- .sidebar -->
			<?php endif; ?>

		</div><!-- .wrapper -->

	</div><!-- module-26-wrapper -->

<?php

// end if there are posts
endif;