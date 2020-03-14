<?php

// vars
$tagline_class = '';
$tagline_style = '';

// primary text
$tagline_title = false;
if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_title' ) ) 
	$tagline_title = wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_title' );

// secondary text
$tagline_subtitle = false;
if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_subtitle' ) ) 
	$tagline_subtitle = wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_subtitle' );

// bg image
$tagline_bg_image = false;

if ( is_singular( 'page' ) && ! is_page_template( 'template-homepage.php') && wonderwall_magazine_get_theme_mod( 'tagline_bg_page', false ) ) {
	$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_page', false );
}

if ( get_the_ID() && ! is_archive() && ! is_search() && wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_bg_image' ) ) 
	$tagline_bg_image = wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_bg_image' );

// singular
if ( is_singular( array( 'post', 'page' ) ) && ! is_page_template( 'template-homepage.php') && ! is_archive() && ! is_search() ) {

	$tagline_title = get_the_title();
	if ( ! $tagline_bg_image ) {
		$tagline_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$tagline_bg_image = $tagline_bg_image[0];
	}

}

// global post data
global $wp_query;

// category
if ( is_category() ) {

	$tagline_title = single_cat_title( '', false );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

	// specific to the tag
	if ( $term_meta = get_option( 'dd_category_meta' ) ) {
		$term = get_queried_object();
		$termID = $term->term_id;
		if ( isset( $term_meta[$termID] ) && isset( $term_meta[$termID]['dd_category_img'] ) ) {
			$tagline_bg_image = $term_meta[$termID]['dd_category_img'];
		}
	}

// tag 
} elseif ( is_tag() ) {

	$tagline_title = single_tag_title( '', false );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

	// specific to the tag
	if ( $term_meta = get_option( 'dd_tags_meta' ) ) {
		$term = get_queried_object();
		$termID = $term->term_id;
		if ( isset( $term_meta[$termID] ) && isset( $term_meta[$termID]['dd_tag_img'] ) ) {
			$tagline_bg_image = $term_meta[$termID]['dd_tag_img'];
		}
	}

// author
} elseif ( is_author() ) {

	$tagline_title = get_the_author();
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

// year
} elseif ( is_year() ) {

	$tagline_title = get_the_date( 'Y' );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

// month
} elseif ( is_month() ) {

	$tagline_title = get_the_date( 'F Y' );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

// day
} elseif ( is_day() ) {

	$tagline_title = get_the_date( 'F j, Y' );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

// post type archive
} elseif ( is_post_type_archive() ) {

	$tagline_title = post_type_archive_title( '', false );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

// taxonomy
} elseif ( is_tax() ) {

	$tagline_title = single_term_title( '', false );
	$tagline_subtitle = $wp_query->post_count . ' ' . esc_html__( 'Articles', 'wonderwall-magazine' );

	// general archive
	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_archives', false );
	}

// search
} elseif ( is_search() ) {

	$tagline_title = get_search_query();
	$tagline_subtitle = esc_html__( 'Search results for:', 'wonderwall-magazine' );

	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_search', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_search', false );
	}

// 404
} elseif ( is_404() ) {
	
	$tagline_title = esc_html__( 'Page not found', 'wonderwall-magazine' );
	$tagline_subtitle = esc_html__( '404', 'wonderwall-magazine' );

	if ( wonderwall_magazine_get_theme_mod( 'tagline_bg_404', false ) ) {
		$tagline_bg_image = wonderwall_magazine_get_theme_mod( 'tagline_bg_404', false );
	}

}

// class
if ( $tagline_bg_image )
	$tagline_class .= 'tagline-has-bg-image ';

// style
if ( $tagline_bg_image )
	$tagline_style .= 'background-image: url("' . $tagline_bg_image . '");';

// with BG image
if ( $tagline_bg_image )
	$styler_tagline_selector = '.tagline-has-bg-image #tagline-title';

?>

<?php if ( ! is_front_page() && ! is_home() && ! is_singular( 'post' ) && ! is_page_template( 'template-homepage.php' ) ) : ?>

	<div id="tagline" class="<?php echo esc_attr( $tagline_class ); ?>" style="<?php echo esc_attr( $tagline_style ); ?>" data-ddst-selector="#tagline" data-ddst-label="Tagline" data-ddst-no-support="typography">

		<?php if ( $tagline_bg_image ) : ?>
			<div class="tagline-overlay"></div>
		<?php endif; ?>

		<div class="wrapper">

			<div id="tagline-inner">

				<?php if ( $tagline_subtitle ) : ?>
					<div class="tagline-subtitle" data-ddst-selector=".tagline-subtitle" data-ddst-label="Tagline Subtitle" data-ddst-no-support="background,border"><?php echo do_shortcode( $tagline_subtitle ); ?></div>
				<?php endif; ?>				

				<?php if ( $tagline_title ) : ?>
					<h1 class="tagline-title" data-ddst-selector=".tagline-title" data-ddst-label="Tagline Title" data-ddst-no-support="background,border"><?php echo do_shortcode( $tagline_title ); ?></h1>
				<?php endif; ?>

			</div><!-- #tagline-inner -->

		</div><!-- .wrapper -->

	</div><!-- #tagline -->

<?php endif; ?>