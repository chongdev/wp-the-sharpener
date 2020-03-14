<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<!-- Meta -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Link -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- WP Head -->
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>	

	<div id="container">

		<div id="page" class="site">

			<header id="header" class="site-header">

				<?php get_template_part( 'template-parts/header/top-bar' ); ?>

				<?php get_template_part( 'template-parts/header/header-main' ); ?>

				<?php get_template_part( 'template-parts/header/navigation' ); ?>				

				<?php get_template_part( 'template-parts/header/tagline' ); ?>

				<?php 

					// default to false
					$featured = false;

					// if a page
					if ( is_singular( 'page' ) ) {

						// get value of featured option
						$featured_type = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_type' );

						// if set and not disabled
						if ( $featured_type && $featured_type !== 'disabled' ) {
							$featured = true;
						}

						// load template
						if ( $featured ) {
							get_template_part( 'template-parts/header/featured-' . $featured_type );
						}

					}	

				?>				

				<?php

					// single post headers
					if ( is_singular( 'post' ) ) {
							
						// get global style
						$style = wonderwall_magazine_get_theme_mod( 'post_style', 'v1' );

						// get local style
						$local_style = false;
						if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'post_style' ) ) {
							$local_style = wonderwall_magazine_get_post_meta( get_the_ID(), 'post_style' );
						}

						// get style
						if ( $local_style && $local_style != 'default' ) {
							$style = $local_style;
						}

						// load if 3 or 4 ( 1 and 2 loaded in template-parts/content-single.php )
						if ( $style == 'v3' ) {
							get_template_part( 'template-parts/single/post-header-3' );
						} elseif ( $style == 'v4' ) {
							get_template_part( 'template-parts/single/post-header-4' );
						}

					}

				?>
					
			</header><!-- #header -->		

			<div id="main" class="site-content">