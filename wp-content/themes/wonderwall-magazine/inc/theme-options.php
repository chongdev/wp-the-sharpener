<?php

/**
 * Register the options
 */
function wonderwall_magazine_customizer_register_options( $options ) {

	$prefix = WONDERWALL_MAGAZINE_CUSTOMIZER_PREPEND;

	// General
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_general',
		'title' => esc_html__( '- General', 'wonderwall-magazine' ),
	);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Logo', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'logo',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Logo - Retina', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'logo_retina',
			'def'	=> '',
		);

	// Social
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_social',
		'title' => esc_html__( '- Social URLs', 'wonderwall-magazine' ),
	);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Twitter URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_twitter',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Facebook URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_facebook',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Youtube URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_youtube',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Vimeo URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_vimeo',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Tumblr URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_tumblr',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Pinterest URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_pinterest',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'LinkedIn URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_linkedin',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Instagram URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_instagram',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Github URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_github',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Google Plus URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_googleplus',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Dribbble URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_dribbble',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Dropbox URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_dropbox',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Flickr URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_flickr',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Foursquare URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_foursquare',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Behance URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_behance',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Vine URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_vine',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'RSS URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_rss',
			'def'	=> '',
		);

	// Social
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_social_other',
		'title' => esc_html__( '- Social APIs', 'wonderwall-magazine' ),
		'descr' => esc_html__( 'These need to be filled out for the Social and Instagram widgets to work. Check the theme documentation for instructions on how to get the needed information.', 'wonderwall-magazine' ),
	);

		// facebook
		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Facebook - Page ID', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_facebook_page_id',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Facebook - App ID', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_facebook_app_id',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Facebook - App Secret', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_facebook_app_secret',
			'def'	=> '',
		);

		// pinterest
		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Pinterest - Username', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_pinterest_username',
			'def'	=> '',
		);

		// twitter
		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Twitter - Username', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_twitter_username',
			'def'	=> '',
		);

		// instagram
		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Instagram - Username', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_instagram_username',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Instagram - Access Token', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_instagram_access_token',
			'def'	=> '',
		);

		// twitter
		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Youtube - Subscriber Count', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_youtube_count',
			'def'	=> '',
		);

	// Header
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_header',
		'title' => esc_html__( '- Header', 'wonderwall-magazine' ),
	);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Top Bar Sticky', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'top_bar_sticky_state',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'light-v1' => esc_html__( 'Light v1', 'wonderwall-magazine' ),
				'light-v2' => esc_html__( 'Light v2', 'wonderwall-magazine' ),
				'dark-v1'  => esc_html__( 'Dark v1', 'wonderwall-magazine' ),
				'dark-v2'  => esc_html__( 'Dark v2', 'wonderwall-magazine' ),
				'dark-v3'  => esc_html__( 'Dark v3', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Style', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'header_style',
			'def'	=> 'light-v1',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Background Image', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'header_bg_image',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Banner - URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'header_banner_url',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Banner - Image', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'header_banner_image',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_textarea',
			'title' => esc_html__( 'Banner - Code', 'wonderwall-magazine' ),
			'descr' => esc_html__( 'Supports HTML and shortcodes. You can put the code from Google Adsense here for example. This will overwrite the custom image banner.', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'header_banner_code',
			'def'	=> '',
		);

	// footer
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_footer',
		'title' => esc_html__( '- Footer', 'wonderwall-magazine' ),
	);		

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Banner - URL', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_banner_url',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Banner - Image', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_banner_image',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_textarea',
			'title' => esc_html__( 'Banner - Code', 'wonderwall-magazine' ),
			'descr' => esc_html__( 'Supports HTML and shortcodes. You can put the code from Google Adsense here for example. This will overwrite the custom image banner.', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_banner_code',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Footer Widgets', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_widgets_state',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Instagram', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_instagram',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Instagram - Access Token', 'wonderwall-magazine' ),
			'descr' => 'You can get an access token at <a target="_blank" href="http://instagram.pixelunion.net">http://instagram.pixelunion.net/</a>',
			'id'	=> $prefix . 'footer_instagram_access_token',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Footer Bottom', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_bottom_state',
			'def'	=> 'enabled',
		);		

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Copyright Text', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_copy_text',
			'def'	=> 'Copyright 2017 Wonderwall By MeridianThemes',
		);		

	// footer
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_footer_subscribe',
		'title' => esc_html__( '- Footer Subscribe', 'wonderwall-magazine' ),
	);	

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Enable/Disable', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_subscribe_state',
			'def'	=> 'enabled',
		);	

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Background Image', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_subscribe_bg_image',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Title', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_subscribe_title',
			'def'	=> 'Subscribe to the newsletter',
		);	

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Subtitle', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_subscribe_subtitle',
			'def'	=> 'Get The Latest Fashion Trends From Our Handpicked Designers Straight Into Your Inbox!',
		);	

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'Content', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_subscribe_content',
			'def'	=> '[optinform]',
		);	

		$options[] = array(
			'type'	=> 'option_text',
			'title' => esc_html__( 'After Content', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'footer_subscribe_after_content',
			'def'	=> 'Don\'t Worry. We Don\'t Spam.',
		);	

	// Post Single
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_post_single',
		'title' => esc_html__( '- Post Single', 'wonderwall-magazine' ),
	);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'v1' => esc_html__( 'Style 1', 'wonderwall-magazine' ),
				'v2' => esc_html__( 'Style 2', 'wonderwall-magazine' ),
				'v3' => esc_html__( 'Style 3', 'wonderwall-magazine' ),
				'v4' => esc_html__( 'Style 4', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Default Style', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'post_style',
			'def'	=> 'v1',
		);	

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Fly-In Next Post', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'fly_in_post_navigation',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled - Theme Elements', 'wonderwall-magazine' ),
				'enabled_addthis' => esc_html__( 'Enabled - AddThis Plugin Elements', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Social Sharing', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'social_sharing',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Featured Image', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'featured_image_state',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Default Featured Image', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'post_featured_image',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Tags ( after content )', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'post_single_tags',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Previous/Next posts ( after content )', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'prev_next_posts',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Comments', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'comments',
			'def'	=> 'enabled',
		);

	// Sidebars
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_sidebars',
		'title' => esc_html__( '- Sidebars', 'wonderwall-magazine' ),
	);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Sticky Sidebar - Post', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'sticky_sidebar_post',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Sticky Sidebar - Page', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'sticky_sidebar_page',
			'def'	=> 'enabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Sticky Sidebar - Homepage', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'sticky_sidebar_homepage',
			'def'	=> 'enabled',
		);

	// Other
	$options[] = array(
		'type'	=> 'section',
		'id'	=> 'wonderwall_magazine_other',
		'title' => esc_html__( '- Other', 'wonderwall-magazine' ),
	);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Show View Counts', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'view_counts',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Featured Video ( in listings )', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'featured_video_listing',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'enabled' => esc_html__( 'Enabled', 'wonderwall-magazine' ),
				'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Scroll To Top Element', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'scroll_to_top',
			'def'	=> 'disabled',
		);

		$options[] = array(
			'type'	=> 'option_select',
			'opts'  => array(
				'classic' => esc_html__( 'Classic', 'wonderwall-magazine' ),
				'masonry' => esc_html__( 'Masonry', 'wonderwall-magazine' ),
			),
			'title' => esc_html__( 'Archive Style', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'archive_style',
			'def'	=> 'classic',
		);	

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Tagline BG - Search Results', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'tagline_bg_search',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Tagline BG - 404 Page', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'tagline_bg_404',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Tagline BG - Archives', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'tagline_bg_archives',
			'def'	=> '',
		);

		$options[] = array(
			'type'	=> 'option_image',
			'title' => esc_html__( 'Tagline BG - Regular Page', 'wonderwall-magazine' ),
			'id'	=> $prefix . 'tagline_bg_page',
			'def'	=> '',
		);

	return $options;

} add_filter( 'wonderwall_magazine_customizer_register', 'wonderwall_magazine_customizer_register_options', 10, 1 );

/**
 * Add options to customizer
 */
function wonderwall_magazine_customizer_register( $wp_customize ) {
	
	$customizer_options = apply_filters( 'wonderwall_magazine_customizer_register', array() );

	$section_priority = 200;
	$setting_priority = 5;
	$current_section_id = '';
	$current_setting_id = '';
	
	foreach ( $customizer_options as $customizer_option ) {

		if( $customizer_option['type'] == 'section' ){
			
			/* New Section */
			
			$section_priority += 50;
			$setting_priority = 5;
			$current_section_id = $customizer_option['id'];

			if ( ! isset( $customizer_option['descr'] ) )
				$customizer_option['descr'] = '';
			
			$wp_customize->add_section( $current_section_id, array(
				'title' => $customizer_option['title'],
				'priority' => $section_priority,
				'description' => $customizer_option['descr']
			) );
			
		} elseif ( $customizer_option['type'] == 'option_color' ) {
			
			/* New Option (COLOR) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default' => $customizer_option['def'],
				'type' => 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $current_setting_id, array(
					'label' => $customizer_option['title'],
					'section' => $current_section_id,
					'priority' => $setting_priority
				) ) );
			
		} elseif ( $customizer_option['type'] == 'option_text' ) {
			
			/* New Option (TEXT) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;

			if ( ! isset( $customizer_option['descr'] ) )
				$customizer_option['descr'] = '';

			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'description' => $customizer_option['descr'],
					'section' 	=> $current_section_id,
					'type'		=> 'text',
					'priority'	=> $setting_priority
				));

		} elseif ( $customizer_option['type'] == 'option_textarea' ) {
			
			/* New Option (TEXT) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;

			if ( ! isset( $customizer_option['descr'] ) )
				$customizer_option['descr'] = '';

			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'wonderwall_magazine_sanitize_textarea',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'description' => $customizer_option['descr'],
					'section' 	=> $current_section_id,
					'type'		=> 'textarea',
					'priority'	=> $setting_priority
				));
			
		} elseif ( $customizer_option['type'] == 'option_select' ) {
			
			/* New Option (SELECT) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'select',
					'choices'	=> $customizer_option['opts'],
					'priority'	=> $setting_priority,
				));
			
		} elseif ( $customizer_option['type'] == 'option_checkbox' ) {
			
			/* New Option (checkbox) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_html',
			) );
				
				$wp_customize->add_control( $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'type'		=> 'checkbox',
					'priority'	=> $setting_priority,
				));
			
		} elseif ( $customizer_option['type'] == 'option_image' ) {
			
			/* New Option (image) */
			
			$current_setting_id = $customizer_option['id'];
			$setting_priority += 5;
			
			$wp_customize->add_setting( $current_setting_id, array(
				'default'	=> $customizer_option['def'],
				'type'		=> 'theme_mod',
				'sanitize_callback' => 'esc_url_raw',
			) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $current_setting_id, array(
					'label'		=> $customizer_option['title'],
					'section' 	=> $current_section_id,
					'priority'	=> $setting_priority,
				) ) );
			
		}
		
	}

} add_action( 'customize_register', 'wonderwall_magazine_customizer_register' );

function wonderwall_magazine_sanitize_textarea( $value ) {
	$allowed_html = array(
		 'a' => array(
			'href' => array(),
			'title' => array()
		),
		'img' => array(
			'src' => array(),
			'alt' => array(),
		),
		'script' => array(
			'async' => array(),
			'src' => array(),
			'type' => array(),
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	);
	return wp_kses( $value, $allowed_html );
}