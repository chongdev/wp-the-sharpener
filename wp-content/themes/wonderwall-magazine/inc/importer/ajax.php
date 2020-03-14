<?php

/**
 * Close
 */

function wonderwall_magazine_importer_ajax_close_installer() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		update_option( 'wonderwall_magazine_ajax_installer', 'closed' );

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_wonderwall-magazine-ajax-close-installer', 'wonderwall_magazine_importer_ajax_close_installer' );

/**
 * Home Pages
 */

function wonderwall_magazine_importer_ajax_install_nav_menus() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		// get locations
		$locations = get_theme_mod('nav_menu_locations');

		/**
		 * Primary
		 */

		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Primary' );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( 'Primary' );		
			$locations['primary'] = $menu_id;
		}

		/**
		 * Footer
		 */

		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Footer' );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( 'Footer' );		
			$locations['footer'] = $menu_id;

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Footer Item #1',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Footer Item #2',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Footer Item #3',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

		}

		/**
		 * Top Bar
		 */

		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Top Bar' );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( 'Top Bar' );		
			$locations['top-bar'] = $menu_id;

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Top Bar Item #1',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Top Bar Item #2',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title' => 'Top Bar Item #3',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish',
			));

		}

		// Set new locations
		set_theme_mod( 'nav_menu_locations', $locations );

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_wonderwall-magazine-ajax-install-nav-menus', 'wonderwall_magazine_importer_ajax_install_nav_menus' );

/**
 * Home Pages
 */

function wonderwall_magazine_importer_ajax_install_home_page() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$datas = array(
			array(
				'post_title' => 'Home #1',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => '6',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-13',
							'spacing' => 'enabled',
							'section_title' => 'Featured Articles',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'ASC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '',
							'banner_image_id' => 0,
							'banner_image' => false,
						),
						1 => array (
							'section' => 'module-banner',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '#',
							'banner_image_id' => 99,
							'banner_image' => '',
						),
						2 => array (
							'section' => 'module-11',
							'spacing' => 'enabled',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #2',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => 'disabled',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'dark-v2',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-22',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '',
							'banner_image_id' => 0,
							'banner_image' => false,
						),
						1 => array (
							'section' => 'module-banner',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '#',
							'banner_image_id' => 99,
							'banner_image' => '',
						),
						2 => array (
							'section' => 'module-7',
							'spacing' => 'enabled',
							'section_title' => 'You Might Also Like',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'ASC',
							'blog_categories' => false,
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),	
				)
			),
			array(
				'post_title' => 'Home #3',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => '4',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-13',
							'spacing' => 'enabled',
							'section_title' => 'Featured Articles',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'ASC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '',
							'banner_image_id' => 0,
							'banner_image' => false,
						),
						1 => array (
							'section' => 'module-banner',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '#',
							'banner_image_id' => 99,
							'banner_image' => '',
						),
						2 => array (
							'section' => 'module-26',
							'spacing' => 'enabled',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #4',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => 'disabled',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'dark-v3',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-11',
							'spacing' => 'enabled',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '6',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #5',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => '2',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'light-v2',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-promo-boxes',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '#',
							'promo_box_1_bg_image_id' => 256,
							'promo_box_1_bg_image' => '',
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '#',
							'promo_box_2_bg_image_id' => 257,
							'promo_box_2_bg_image' => '',
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '#',
							'promo_box_3_bg_image_id' => 258,
							'promo_box_3_bg_image' => '',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '',
							'banner_image_id' => 0,
							'banner_image' => false,
						), 
						1 => array (
							'section' => 'module-banner',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '#',
							'banner_image_id' => 99,
							'banner_image' => '',
						),
						2 => array (
							'section' => 'module-24',
							'spacing' => 'enabled',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #6',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => '7',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'dark-v1',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-banner',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '#',
							'banner_image_id' => 99,
							'banner_image' => '',
						),
						1 => array (
							'section' => 'module-11',
							'spacing' => 'enabled',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #7',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => 'disabled',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'light-v2',
					'_wonderwall_magazine_home_sections' => array(
						0 => array (
							'section' => 'module-25',
							'spacing' => 'enabled',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #8',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => '5',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'light-v2',
					'_wonderwall_magazine_home_sections' => array(
					 	0 => array (
							'section' => 'module-promo-boxes',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '#',
							'promo_box_1_bg_image_id' => 256,
							'promo_box_1_bg_image' => '',
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '#',
							'promo_box_2_bg_image_id' => 257,
							'promo_box_2_bg_image' => '',
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '#',
							'promo_box_3_bg_image_id' => 258,
							'promo_box_3_bg_image' => '',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '',
							'banner_image_id' => 0,
							'banner_image' => false,
						),
						1 => array (
							'section' => 'module-11',
							'spacing' => 'enabled',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
			array(
				'post_title' => 'Home #9',
				'meta' => array(
					'_wonderwall_magazine_featured_type' => '3',
					'_wonderwall_magazine_featured_tag' => 'featured',
					'_wonderwall_magazine_header_style' => 'light-v2',
					'_wonderwall_magazine_home_sections' => array(
					 	0 => array (
							'section' => 'module-banner',
							'spacing' => 'enabled',
							'section_title' => '',
							'section_title_url' => '',
							'module_11_featured' => 'enabled',
							'module_12_featured' => 'enabled',
							'posts_per_page' => '',
							'pagination' => 'disabled',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_categories' => false,
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_1_url' => '',
							'promo_box_1_bg_image_id' => 0,
							'promo_box_1_bg_image' => false,
							'promo_box_2_title' => 'instagram',
							'promo_box_2_url' => '',
							'promo_box_2_bg_image_id' => 0,
							'promo_box_2_bg_image' => false,
							'promo_box_3_title' => 'photography',
							'promo_box_3_url' => '',
							'promo_box_3_bg_image_id' => 0,
							'promo_box_3_bg_image' => false,
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_content' => '',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'subscribe_bg_image_id' => 0,
							'subscribe_bg_image' => false,
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
							'search_bg_image_id' => 0,
							'search_bg_image' => false,
							'banner_url' => '#',
							'banner_image_id' => 99,
							'banner_image' => '',
						),
						1 => array (
							'section' => 'module-11',
							'spacing' => 'enabled',
							'module_11_featured' => 'disabled',
							'module_12_featured' => 'enabled',
							'pagination' => 'enabled_classic',
							'post_orderby' => 'date',
							'post_order' => 'DESC',
							'blog_exclude_tags' => '',
							'promo_box_1_title' => 'about me',
							'promo_box_2_title' => 'instagram',
							'promo_box_3_title' => 'photography',
							'subscribe_style' => 'full_width',
							'subscribe_title' => 'Subscribe To The Newsletter',
							'subscribe_subtitle' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
							'subscribe_after_content' => 'Don\'t Worry, We Don\'t Spam.',
							'search_style' => 'full_width',
							'search_title' => 'Looking for something specific? Search The Website.',
						),
					),
				)
			),
		);
		
		$menu = wp_get_nav_menu_object( 'Primary' );
		$menu = $menu->term_id;

		$count = 0;

		foreach ( $datas as $data ) {
			
			$count++;

			// Create post object
			$the_post = array(
				'post_title' => $data['post_title'],
				'post_status' => 'publish',
				'post_type' => 'page',
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			// If post added
			if ( $post_id ) {

				// set homepage template
				update_post_meta( $post_id, '_wp_page_template', 'template-homepage.php' );

				// Set as front page
				if ( $count == 1 ) {
					update_option( 'page_on_front', $post_id );
					update_option( 'show_on_front', 'page' );
				}

				// if meta is set
				if ( isset( $data['meta'] ) ) {
					foreach ( $data['meta'] as $meta_key => $meta_value ) {
						update_post_meta( $post_id, $meta_key, $meta_value );
					}
				}

				// add to menu
				if ( $count == 1) {
					$menu_parent = wp_update_nav_menu_item( $menu, 0, array(
						'menu-item-title' => 'Home',
						'menu-item-object' => 'page',
						'menu-item-object-id' => $post_id,
						'menu-item-type' => 'post_type',
						'menu-item-status' => 'publish',
						'menu-item-parent-id' => 0,
					));
					wp_update_nav_menu_item( $menu, 0, array(
						'menu-item-title' => $data['post_title'],
						'menu-item-object' => 'page',
						'menu-item-object-id' => $post_id,
						'menu-item-type' => 'post_type',
						'menu-item-status' => 'publish',
						'menu-item-parent-id' => $menu_parent,
					));
				} else {
					wp_update_nav_menu_item( $menu, 0, array(
						'menu-item-title' => $data['post_title'],
						'menu-item-object' => 'page',
						'menu-item-object-id' => $post_id,
						'menu-item-type' => 'post_type',
						'menu-item-status' => 'publish',
						'menu-item-parent-id' => $menu_parent,
					));
				}

			} else {
				$response['status'] = 'fail';
			}

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_wonderwall-magazine-ajax-install-home-page', 'wonderwall_magazine_importer_ajax_install_home_page' );

/**
 * Contact page
 */

function wonderwall_magazine_importer_ajax_install_contact_page() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$post_excerpt = 'Curabitur congue dolor sed massa feugiat, sit amet tempor orci convallis. Donec lacus magna, semper eget nisl sed, posuere pellentesque tellus. Cras mauris tellus, ultricies quis hendrerit imperdiet, faucibus non nulla. Cras ex dolor, aliquet eget enim nec, luctus congue nisi. Fusce facilisis in erat vitae cursus. ';
		$post_content = 'Nunc est ex, condimentum nec auctor quis, dignissim eget lacus. Pellentesque metus lorem, varius vitae erat tincidunt, elementum auctor arcu. Morbi ullamcorper enim in velit malesuada pellentesque. Cras aliquet nunc lacus, non malesuada orci suscipit sit amet. Nam ut maximus purus. Aliquam blandit ex eros, a semper tellus pellentesque eu. Cras aliquam dolor ac mauris viverra facilisis. Pellentesque ipsum mi, porttitor a odio eu, accumsan vulputate nulla.

		Insert contact form shortcode here';

		$url = get_template_directory_uri() . '/inc/importer/images/placeholder.png';
		$tmp = download_url( $url );
		$post_id = 0;
		$desc = 'Placeholder';
		$file_array = array();

		// Set variables for storage
		// fix file filename for query strings
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
		$file_array['name'] = 'placeholder.png';
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}
		
		for ( $i=1; $i <= 1; $i++ ) { 
			
			$date = $i;
			if ( $i < 10 ) {
				$date = '0' . $i;
			}

			// Create post object
			$the_post = array(
				'post_title' => 'Contact',
				'post_status' => 'publish',
				'post_type' => 'page',
				'post_content' => $post_content,
				'post_excerpt' => $post_excerpt,
				'post_date' => date( '2017-04-01 ' . $date . ':00:00' )
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			if ( $post_id && $id ) {
				add_post_meta($post_id, '_thumbnail_id', $id, true);
			}

			// Add to menu
			$menu = wp_get_nav_menu_object( 'Primary' );
			$menu = $menu->term_id;
			wp_update_nav_menu_item( $menu, 0, array(
				'menu-item-title' => 'Contact',
				'menu-item-object' => 'page',
				'menu-item-object-id' => $post_id,
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish',
				'menu-item-parent-id' => 0,
			));

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_wonderwall-magazine-ajax-install-contact-page', 'wonderwall_magazine_importer_ajax_install_contact_page' );

/**
 * Blog Posts
 */

function wonderwall_magazine_importer_ajax_install_blog_posts() {

	// Allowed to do this?
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

		$response = array();
		$response['status'] = 'success';

		$post_excerpt = 'Curabitur congue dolor sed massa feugiat, sit amet tempor orci convallis. Donec lacus magna, semper eget nisl sed, posuere pellentesque tellus. Cras mauris tellus, ultricies quis hendrerit imperdiet, faucibus non nulla. Cras ex dolor, aliquet eget enim nec, luctus congue nisi. Fusce facilisis in erat vitae cursus. ';
		$post_content = 'Mauris vehicula efficitur mi, vel sollicitudin lectus vulputate a. Phasellus vulputate nunc libero, eu faucibus sem bibendum in. Aenean mollis quis diam sed cursus. Integer tristique rhoncus sapien vitae semper. Mauris euismod venenatis sem vitae congue.

Duis ullamcorper diam eget porttitor sagittis. Mauris porttitor magna in interdum vestibulum. Integer nec cursus neque. Mauris eu nibh rhoncus, laoreet sapien id, tincidunt turpis. Etiam mattis dapibus laoreet. Vestibulum bibendum tortor vel felis commodo ultrices. In in elit vitae eros suscipit commodo ut tristique erat. Vestibulum vehicula turpis id quam euismod vulputate.

Quisque lacinia, purus non porta malesuada, lectus tortor iaculis odio, nec laoreet massa dui sit amet elit. Sed tempus bibendum nisi eget vehicula. Maecenas quis leo eu augue faucibus aliquam.

Quisque sed pharetra odio, eu consectetur dui. Etiam scelerisque sagittis nunc, a scelerisque lorem. Fusce commodo tempus diam sed hendrerit. In ullamcorper odio eu pretium consectetur.

Proin quis nunc ut quam fermentum dignissim. Fusce mi nisl, auctor non laoreet a, auctor vel sem. Ut quis ex quis turpis accumsan molestie. Cras lobortis, elit vitae tincidunt varius, arcu augue vehicula tellus, vel aliquet ante odio eu mi. Nam nec nulla elit.

Quisque lacinia, purus non porta malesuada, lectus tortor iaculis odio, nec laoreet massa dui sit amet elit.';

		$url = get_template_directory_uri() . '/inc/importer/images/placeholder.png';
		$tmp = download_url( $url );
		$post_id = 0;
		$desc = 'Placeholder';
		$file_array = array();

		// Set variables for storage
		// fix file filename for query strings
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
		$file_array['name'] = 'placeholder.png';
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$id = media_handle_sideload( $file_array, $post_id, $desc );

		// If error storing permanently, unlink
		if ( is_wp_error($id) ) {
			@unlink($file_array['tmp_name']);
			return $id;
		}
		
		for ( $i=1; $i <= 10; $i++ ) { 
			
			$date = $i;
			if ( $i < 10 ) {
				$date = '0' . $i;
			}

			// Create post object
			$the_post = array(
				'post_title' => 'Example Blog Post #' . $i,
				'post_status' => 'publish',
				'post_type' => 'post',
				'post_content' => $post_content,
				'post_excerpt' => $post_excerpt,
				'post_date' => date( '2017-04-01 ' . $date . ':00:00' )
			);

			// Insert the post into the database
			$post_id = wp_insert_post( $the_post );

			if ( $post_id && $id ) {
				add_post_meta($post_id, '_thumbnail_id', $id, true);
			}

			if ( $i < 6 ) {
				wp_set_post_terms( $post_id, 'featured', 'post_tag' );
			}			

		}

		// Encode response
		$response_json = json_encode( $response );	

		// AJAX phone home
		header( "Content-Type: application/json" );
		echo $response_json;

		// Asta la vista
		exit;

	}
			
} add_action( 'wp_ajax_wonderwall-magazine-ajax-install-blog-posts', 'wonderwall_magazine_importer_ajax_install_blog_posts' );