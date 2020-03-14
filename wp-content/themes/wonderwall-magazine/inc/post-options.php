<?php
/**
 * Post Options
 */

/**
 * Add post options
 */
function wonderwall_magazine_post_options_register() {

	// Blog categories
	$blog_categories = get_terms( 'category' );
	$blog_categories_options = array();
	if ( ! is_wp_error( $blog_categories ) ) {
		foreach ( $blog_categories as $blog_category ) {
			$blog_categories_options[$blog_category->term_id] = $blog_category->name;
		}
	}

	$prefix = '_wonderwall_magazine_';

	/**
	 * general page options
	 */

	$page_general_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page_options',
		'title'         => esc_html__( 'General Options', 'wonderwall-magazine' ),
		'object_types'  => array( 'page' ),
	) );

		$page_general_opts->add_field( array(
			'name'       => esc_html__( 'Layout', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'The layout for this page ( with or without sidebar ).', 'wonderwall-magazine' ),
			'id'         => $prefix . 'layout',
			'type'       => 'select',
			'default'    => 'no_sidebar',
			'options'    => array(
				'no_sidebar'  => esc_html__( 'Full Content', 'wonderwall-magazine' ),
				'right_sidebar' => esc_html__( 'Content + Sidebar', 'wonderwall-magazine' ),
				'left_sidebar' => esc_html__( 'Sidebar + Content', 'wonderwall-magazine' ),
			),
		) );

		$page_general_opts->add_field( array(
			'name'       => esc_html__( 'Sticky Sidebar', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Enable/disable sticky sidebar. If set to default, the value from Customizer will be used.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'sticky_sidebar',
			'type'       => 'select',
			'default'    => '',
			'options'    => array(
				'default'  => esc_html__( 'Default', 'wonderwall-magazine' ),
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
		) );

	/**
	 * header options
	 */

	$header_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_header',
		'title'         => esc_html__( 'Header Options', 'wonderwall-magazine' ),
		'object_types'  => array( 'page', 'post' ),
	) );

		$header_opts->add_field( array(
			'name'       => esc_html__( 'Header Style', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'The style of header. The value from the Customizer will be used if set to default.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'header_style',
			'type'       => 'select',
			'default'    => 'default',
			'options'    => array(
				'default'  => esc_html__( 'Default', 'wonderwall-magazine' ),
				'light-v1' => esc_html__( 'Light v1', 'wonderwall-magazine' ),
				'light-v2' => esc_html__( 'Light v2', 'wonderwall-magazine' ),
				'dark-v1'  => esc_html__( 'Dark v1', 'wonderwall-magazine' ),
				'dark-v2'  => esc_html__( 'Dark v2', 'wonderwall-magazine' ),
				'dark-v3'  => esc_html__( 'Dark v3', 'wonderwall-magazine' ),
			),
		) );

		$header_opts->add_field( array(
			'name'       => esc_html__( 'Logo', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Custom logo for this page. The logo set in the Customzier will be used if no image set here.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'header_logo',
			'type'       => 'file',
			'default'    => '',
		) );

		$header_opts->add_field( array(
			'name'       => esc_html__( 'Background Image', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Custom background image for this page. If not set the image from Customizer options will be used.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'header_bg_image',
			'type'       => 'file',
			'default'    => '',
		) );

	/**
	 * Tagline ( Page )
	 */

	$tagline_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_tagline',
		'title'         => esc_html__( 'Tagline Options', 'wonderwall-magazine' ),
		'object_types'  => array( 'page' ),
	) );

		$tagline_opts->add_field( array(
			'name'       => esc_html__( 'Primary Title', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Primary title for the tagline section.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'tagline_title',
			'type'       => 'textarea',
			'default'    => '',
		) );

		$tagline_opts->add_field( array(
			'name'       => esc_html__( 'Secondary Title', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Secondary title for the tagline section.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'tagline_subtitle',
			'type'       => 'textarea',
			'default'    => '',
		) );

		$tagline_opts->add_field( array(
			'name'       => esc_html__( 'Tagline Background Image', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Background image the tagline section.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'tagline_bg_image',
			'type'       => 'file',
			'default'    => '',
		) );

	/**
	 * Post Options
	 */

	$post_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_post_options',
		'title'         => esc_html__( 'Post Options', 'wonderwall-magazine' ),
		'object_types'  => array( 'post' ),
	) );

		$post_opts->add_field( array(
			'name'       => esc_html__( 'Layout', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'The layout for this page ( with or without sidebar )', 'wonderwall-magazine' ),
			'id'         => $prefix . 'layout',
			'type'       => 'select',
			'default'    => 'right_sidebar',
			'options'    => array(
				'no_sidebar'  => esc_html__( 'Full Content', 'wonderwall-magazine' ),
				'right_sidebar' => esc_html__( 'Content + Sidebar', 'wonderwall-magazine' ),
				'left_sidebar' => esc_html__( 'Sidebar + Content', 'wonderwall-magazine' ),
			),
		) );

		$post_opts->add_field( array(
			'name'       => esc_html__( 'Sticky Sidebar', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Enable/disable sticky sidebar. If set to default, the value from Customizer will be used.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'sticky_sidebar',
			'type'       => 'select',
			'default'    => '',
			'options'    => array(
				'default'  => esc_html__( 'Default', 'wonderwall-magazine' ),
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
		) );

		$post_opts->add_field( array(
			'name'       => esc_html__( 'Featured Video', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Simply enter the URL to the youtube/vimeo/... video. Shows instead of the featured image on the blog post single page. Note: Does not work for style 2 and style 3 ( the option below ).', 'wonderwall-magazine' ),
			'id'         => $prefix . 'featured_video',
			'type'       => 'text',
		) );

		$post_opts->add_field( array(
			'name'       => esc_html__( 'Single Post Page Style', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'The style of the single blog post page.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'post_style',
			'type'       => 'select',
			'default'    => 'default',
			'options'    => array(
				'default'  => esc_html__( 'Default', 'wonderwall-magazine' ),
				'v1' => esc_html__( 'Style 1', 'wonderwall-magazine' ),
				'v2' => esc_html__( 'Style 2', 'wonderwall-magazine' ),
				'v3'  => esc_html__( 'Style 3', 'wonderwall-magazine' ),
				'v4'  => esc_html__( 'Style 4', 'wonderwall-magazine' ),
			),
		) );

		$post_opts->add_field( array(
			'name'       => esc_html__( 'Modules 25 and 26 Style', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'How this post looks like in those 2 modules.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'm_25_26_style',
			'type'       => 'select',
			'default'    => 'text_below_thumb',
			'options'    => array(
				'text_below_thumb' => esc_html__( 'Text below thumbnail', 'wonderwall-magazine' ),
				'text_inside_thumb' => esc_html__( 'Text inside thumbnail', 'wonderwall-magazine' ),
			),
		) );

		$post_opts->add_field( array(
			'name'       => esc_html__( 'Gallery', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Gallery of images for this post.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'gallery',
			'type'       => 'file_list',
			'default'    => '',
		) );

	/**
	 * Featured options
	 */

	$page_featured_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_featured',
		'title'         => esc_html__( 'Featured Section', 'wonderwall-magazine' ),
		'object_types'  => array( 'page' ),
	) );

		$page_featured_opts->add_field( array(
			'name' => esc_html__( 'What is a featured section?', 'wonderwall-magazine' ),
			'desc' => esc_html__( 'The featured section area is a blog listing shown just below the navigation. It is meant to be used on the homepage but you may use it on any page you want.', 'wonderwall-magazine' ),
			'type' => 'title',
			'id' => $prefix . 'featured_section_a_title'
		) );

		$page_featured_opts->add_field( array(
			'name'       => esc_html__( 'Style', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Which style should the featured section have?.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'featured_type',
			'type'       => 'select',
			'options'    => array(
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
				'1'        => esc_html__( 'Style 1', 'wonderwall-magazine' ),
				'2'        => esc_html__( 'Style 2', 'wonderwall-magazine' ),
				'3'        => esc_html__( 'Style 3', 'wonderwall-magazine' ),
				'4'        => esc_html__( 'Style 4', 'wonderwall-magazine' ),
				'5'        => esc_html__( 'Style 5', 'wonderwall-magazine' ),
				'6'        => esc_html__( 'Style 6', 'wonderwall-magazine' ),
				'7'        => esc_html__( 'Style 7', 'wonderwall-magazine' ),
			),
		) );

		$page_featured_opts->add_field( array(
			'name'       => esc_html__( 'Tag', 'wonderwall-magazine' ),
			'desc'       => esc_html__( 'Which tag should be used to get the posts for the featured section.', 'wonderwall-magazine' ),
			'id'         => $prefix . 'featured_tag',
			'type'       => 'text',
			'default'    => 'featured',
		) );

	/**
	 * Page options
	 */

	$page_opts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page',
		'title'         => esc_html__( 'Content Sections', 'wonderwall-magazine' ),
		'object_types'  => array( 'page', ),
	) );

		$page_opts->add_field( array(
			'name' => esc_html__( 'What are content sections?', 'wonderwall-magazine' ),
			'desc' => esc_html__( 'These sections will be displayed in the main area of the page. They are meant to be used on a homepage but you may use them on any page you like. There are over 15 different modules to choose from.', 'wonderwall-magazine' ),
			'type' => 'title',
			'id' => $prefix . 'sections_a_title'
		) );

		// Sections
		$page_group_field = $page_opts->add_field( array(
			'id'          => $prefix . 'home_sections',
			'name'        => '',
			'type'        => 'group',
			'description' => esc_html__( '', 'wonderwall-magazine' ),
			'repeatable'  => true,
			'options'     => array(
				'group_title'   => esc_html__( 'Section {#}', 'wonderwall-magazine' ),
				'add_button'    => esc_html__( 'Add Section', 'wonderwall-magazine' ),
				'remove_button' => esc_html__( 'Remove Section', 'wonderwall-magazine' ),
				'sortable'      => true,
				'closed'        => true
			),
		) );

			/* sections */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Module', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Which module should the section use?', 'wonderwall-magazine' ),
				'id'   => 'section',
				'type' => 'select',
				'default' => 'none',
				'options' => array(
					'none'     => esc_html__( '- Select -', 'wonderwall-magazine' ),
					'module-6' => esc_html__( 'Posts - 2 Column Grid + Sidebar', 'wonderwall-magazine' ),
					'module-7' => esc_html__( 'Posts - 3 Column Grid', 'wonderwall-magazine' ),
					'module-13' => esc_html__( 'Posts - 4 Column Grid', 'wonderwall-magazine' ),
					'module-12' => esc_html__( 'Posts - Classic v1', 'wonderwall-magazine' ),
					'module-11' => esc_html__( 'Posts - Classic + Sidebar v1', 'wonderwall-magazine' ),
					'module-21' => esc_html__( 'Posts - Classic + Sidebar v2', 'wonderwall-magazine' ),
					'module-22' => esc_html__( 'Posts - Classic + Sidebar v3', 'wonderwall-magazine' ),
					'module-24' => esc_html__( 'Posts - Classic + Sidebar v4', 'wonderwall-magazine' ),
					'module-25' => esc_html__( 'Posts - Masonry', 'wonderwall-magazine' ),
					'module-26' => esc_html__( 'Posts - Masonry + Sidebar', 'wonderwall-magazine' ),
					'module-promo-boxes' => esc_html__( 'Promo Boxes', 'wonderwall-magazine' ),
					'module-subscribe' => esc_html__( 'Subscribe', 'wonderwall-magazine' ),
					'module-banner' =>  esc_html__( 'Banner', 'wonderwall-magazine' ),
					'module-custom' =>  esc_html__( 'Custom Content', 'wonderwall-magazine' ),
				)
			) );
			
			// spacing
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Spacing ( above )', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Should this module have a spacing ( above )', 'wonderwall-magazine' ),
				'id'   => 'spacing',
				'type' => 'select',
				'default' => 'enabled',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
					'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),					
				)
			) );			

			/* Section Title */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Heading Title', 'wonderwall-magazine' ),
				'description' => esc_html__( 'The title for the heading element displayed at the top.', 'wonderwall-magazine' ),
				'id'   => 'section_title',
				'type' => 'text',
				'default' => '',
			) );

			/* Section Link */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Heading URL', 'wonderwall-magazine' ),
				'description' => esc_html__( 'The URL to which the heading element will be linked. Leave empty for no linking.', 'wonderwall-magazine' ),
				'id'   => 'section_title_url',
				'type' => 'text',
				'default' => '',
			) );

			/* module 11 - featured post */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'First Post Featured', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Should the first post in the module have a featured style?', 'wonderwall-magazine' ),
				'id'   => 'module_11_featured',
				'type' => 'select',
				'default' => 'enabled',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
					'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),					
				)
			) );

			/* module 12 - featured post */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'First Post Featured', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Should the first post in the module have a featured style?', 'wonderwall-magazine' ),
				'id'   => 'module_12_featured',
				'type' => 'select',
				'default' => 'enabled',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
					'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),					
				)
			) );

			/* amount of posts */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Amount of posts', 'wonderwall-magazine' ),
				'description' => esc_html__( 'How many posts do you want to show. If empty the amount of posts will default to the best one that fits the chosen module.', 'wonderwall-magazine' ),
				'id'   => 'posts_per_page',
				'type' => 'text',
			) );

			/* module 5 - pagination */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Pagination ( load more )', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Should there be a load more functionality in this module?', 'wonderwall-magazine' ),
				'id'   => 'pagination',
				'type' => 'select',
				'default' => '',
				'options' => array(
					'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
					'enabled_classic'  => esc_html__( 'Enabled - Classic', 'wonderwall-magazine' ),
					'enabled' => esc_html__( 'Enabled - AJAX Load More', 'wonderwall-magazine' ),
				)
			) );

			/* order by */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Order By', 'wonderwall-magazine' ),
				'description' => esc_html__( 'What should the posts be ordered by?', 'wonderwall-magazine' ),
				'id'   => 'post_orderby',
				'type' => 'select',
				'default_cb' => 'date',
				'options' => array(
					'date' => esc_html__( 'Publish Date', 'wonderwall-magazine' ),
					'modified' => esc_html__( 'Modified Date', 'wonderwall-magazine' ),
					'title' => esc_html__( 'Title', 'wonderwall-magazine' ),
					'comment_count' => esc_html__( 'Comment Count', 'wonderwall-magazine' ),
					'rand' => esc_html__( 'Random', 'wonderwall-magazine' ),
				)
			) );

			/* order by */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Order', 'wonderwall-magazine' ),
				'description' => esc_html__( 'What order should the posts be shown in?', 'wonderwall-magazine' ), 
				'id'   => 'post_order',
				'type' => 'select',
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'Descending', 'wonderwall-magazine' ),
					'ASC' => esc_html__( 'Ascending', 'wonderwall-magazine' ),
				)
			) );

			/* blog categories */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Blog Categories', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Which categories do you want to display in this module. If none selected all categories will be included.', 'wonderwall-magazine' ),
				'id'   => 'blog_categories',
				'type' => 'multicheck',
				'default' => '',
				'options' => $blog_categories_options
			) );

			/* blog categories */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Exclude Tags', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Which tags should be excluded. Eventer the tag slug. If multiple, separate by a single space.', 'wonderwall-magazine' ),
				'id'   => 'blog_exclude_tags',
				'type' => 'text',
				'default' => '',
			) );

			/* sticky sidebar */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Sticky Sidebar', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Enable/disable sticky sidebar. If set to default, the value from Customizer will be used.', 'wonderwall-magazine' ), 
				'id'   => 'sticky_sidebar',
				'type' => 'select',
				'default' => '',
				'options' => array(
					'default' => esc_html__( 'Default', 'wonderwall-magazine' ),
					'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
					'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
				)
			) );

			/* promo boxes */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 1 - Title', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Title for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_1_title',
				'default' => 'about me',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 1 - URL', 'wonderwall-magazine' ),
				'description' => esc_html__( 'URL for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_1_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 1 - BG Image', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Background image for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_1_bg_image',
				'type' => 'file',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 2 - Title', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Title for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_2_title',
				'default' => 'instagram',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 2 - URL', 'wonderwall-magazine' ),
				'description' => esc_html__( 'URL for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_2_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 2 - BG Image', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Background image for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_2_bg_image',
				'type' => 'file',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 3 - Title', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Title for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_3_title',
				'default' => 'photography',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 3 - URL', 'wonderwall-magazine' ),
				'description' => esc_html__( 'URL for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_3_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Promo Box 3 - BG Image', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Background image for the promo box.', 'wonderwall-magazine' ),
				'id'   => 'promo_box_3_bg_image',
				'type' => 'file',
			) );

			/* subscribe */
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Subscribe - Style', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Choose the style for the subscribe section.', 'wonderwall-magazine' ),
				'id'   => 'subscribe_style',
				'type' => 'select',
				'default' => 'full_width',
				'options' => array(
					'full_width' => esc_html__( 'Full Width', 'wonderwall-magazine' ),
					'wrapped' => esc_html__( 'Wrapped', 'wonderwall-magazine' ),
				)
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Subscribe - Title', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Title for the subscribe section.', 'wonderwall-magazine' ),
				'id'   => 'subscribe_title',
				'default' => 'Subscribe To The Newsletter',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Subscribe - Subtitle', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Subtitle for the subscribe section.', 'wonderwall-magazine' ),
				'id'   => 'subscribe_subtitle',
				'default' => 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Subscribe - Content', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Content for the subscribe section.', 'wonderwall-magazine' ),
				'id'   => 'subscribe_content',
				'type' => 'textarea',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Subscribe - After Content', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Text to show after the content.', 'wonderwall-magazine' ),
				'id'   => 'subscribe_after_content',
				'default' => 'Don\'t Worry, We Don\'t Spam.',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Subscribe - BG Image', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Background image for the subscribe section.', 'wonderwall-magazine' ),
				'id'   => 'subscribe_bg_image',
				'type' => 'file',
			) );

			/* search */
			/*
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Search - Style', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Choose the style for the search section.', 'wonderwall-magazine' ),
				'id'   => 'search_style',
				'type' => 'select',
				'default' => 'full_width',
				'options' => array(
					'full_width' => esc_html__( 'Full Width', 'wonderwall-magazine' ),
					'wrapped' => esc_html__( 'Wrapped', 'wonderwall-magazine' ),
				)
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Search - Title', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Title for the search section.', 'wonderwall-magazine' ),
				'id'   => 'search_title',
				'default' => 'Looking for something specific? Search The Website.',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Search - BG Image', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Background image for the search section.', 'wonderwall-magazine' ),
				'id'   => 'search_bg_image',
				'type' => 'file',
			) );
			*/

			// banner

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Banner - URL', 'wonderwall-magazine' ),
				'description' => esc_html__( 'URL for the banner section.', 'wonderwall-magazine' ),
				'id'   => 'banner_url',
				'type' => 'text',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Banner - Image', 'wonderwall-magazine' ),
				'description' => esc_html__( 'Image for the banner section.', 'wonderwall-magazine' ),
				'id'   => 'banner_image',
				'type' => 'file',
			) );

			// custom content
			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Custom Content', 'wonderwall-magazine' ),
				'description' => esc_html__( 'The custom content for the module.', 'wonderwall-magazine' ),
				'id'   => 'custom_content',
				'type' => 'textarea',
			) );

			$page_opts->add_group_field( $page_group_field, array(
				'name' => esc_html__( 'Layout', 'wonderwall-magazine' ),
				'description' => esc_html__( 'The layout for the custom content area.', 'wonderwall-magazine' ),
				'id'   => 'custom_content_layout',
				'type' => 'select',
				'default'    => '',
				'options'    => array(
					'wrapped'  => esc_html__( 'Wrapped', 'wonderwall-magazine' ),
					'full' => esc_html__( 'Full Width', 'wonderwall-magazine' ),
				),
			) );



} add_action( 'cmb2_admin_init', 'wonderwall_magazine_post_options_register' );