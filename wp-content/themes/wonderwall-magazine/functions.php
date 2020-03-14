<?php
/**
 * Table Of Contents
 *
 * wonderwall_magazine_setup ( Sets up theme defaults and registers support for various WordPress features )
 * wonderwall_magazine_content_width ( Set the content width global variable )
 * wonderwall_magazine_register_sidebars ( Register sidebars )
 * wonderwall_magazine_scripts ( Enqueue scripts and styles )
 * wonderwall_magazine_admin_scripts ( Enqueue admin scripts and styles )
 * Include other files
 */

/**
 * Global Vars
 */

define( 'WONDERWALL_MAGAZINE_SOURCE', 'themeforest' );
define( 'WONDERWALL_MAGAZINE_THEME_VER', '1.0.1' );
define( 'WONDERWALL_MAGAZINE_CUSTOMIZER_PREPEND', 'wonderwall_magazine_theme_' );

if ( ! function_exists( 'wonderwall_magazine_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_setup() {
		
		// Translation
		load_theme_textdomain( 'wonderwall-magazine', get_template_directory() . '/languages' );

		// Theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Register Menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'wonderwall-magazine' ),
			'top-bar' => esc_html__( 'Top Bar', 'wonderwall-magazine' ),
			'footer' => esc_html__( 'Footer', 'wonderwall-magazine' ),
		) );

	}

} add_action( 'after_setup_theme', 'wonderwall_magazine_setup' );

if ( ! function_exists( 'wonderwall_magazine_content_width' ) ) {

	/**
	 * Set the content width global variable
	 *
	 * @since 1.0
	 * @global int $content_width
	 */
	function wonderwall_magazine_content_width() {
		
		$GLOBALS['content_width'] = apply_filters( 'wonderwall_magazine_content_width', 1100 );

	}

} add_action( 'after_setup_theme', 'wonderwall_magazine_content_width', 0 );

if ( ! function_exists( 'wonderwall_magazine_register_sidebars' ) ) {

	/**
	 * Register Sidebars
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_register_sidebars() {

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'wonderwall-magazine' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector="#sidebar .widget-title" data-ddst-label="Sidebar - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 6
		register_sidebar( array(
			'name'          => esc_html__( 'Module 2 Column Grid + Sidebar', 'wonderwall-magazine' ),
			'id'            => 'sidebar-m-6',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector=".sidebar .widget-title" data-ddst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 11
		register_sidebar( array(
			'name'          => esc_html__( 'Module Classic + Sidebar v1', 'wonderwall-magazine' ),
			'id'            => 'sidebar-m-11',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector=".sidebar .widget-title" data-ddst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 21
		register_sidebar( array(
			'name'          => esc_html__( 'Module Classic + Sidebar v2', 'wonderwall-magazine' ),
			'id'            => 'sidebar-m-21',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector=".sidebar .widget-title" data-ddst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 22
		register_sidebar( array(
			'name'          => esc_html__( 'Module Classic + Sidebar v3', 'wonderwall-magazine' ),
			'id'            => 'sidebar-m-22',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector=".sidebar .widget-title" data-ddst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 24
		register_sidebar( array(
			'name'          => esc_html__( 'Module Classic + Sidebar v4', 'wonderwall-magazine' ),
			'id'            => 'sidebar-m-24',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector=".sidebar .widget-title" data-ddst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// module 26
		register_sidebar( array(
			'name'          => esc_html__( 'Module Masonry + Sidebar', 'wonderwall-magazine' ),
			'id'            => 'sidebar-m-26',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector=".sidebar .widget-title" data-ddst-label="Module - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// footer column 1
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 1', 'wonderwall-magazine' ),
			'id'            => 'sidebar-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s" data-ddst-selector="#footer-widgets .widget" data-ddst-label="Footer - Widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector="#footer .widget-title" data-ddst-label="Footer - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// footer column 2
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 2', 'wonderwall-magazine' ),
			'id'            => 'sidebar-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s" data-ddst-selector="#footer-widgets .widget" data-ddst-label="Footer - Widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector="#footer .widget-title" data-ddst-label="Footer - Widget Title">',
			'after_title'   => '</h2>',
		) );

		// footer column 3
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 3', 'wonderwall-magazine' ),
			'id'            => 'sidebar-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s" data-ddst-selector="#footer-widgets .widget" data-ddst-label="Footer - Widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" data-ddst-selector="#footer .widget-title" data-ddst-label="Footer - Widget Title">',
			'after_title'   => '</h2>',
		) );

	}

} add_action( 'widgets_init', 'wonderwall_magazine_register_sidebars' );

if ( ! function_exists( 'wonderwall_magazine_scripts' ) ) {
	
	/**
	 * Enqueue scripts and styles
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_scripts() {

		// Styles
		wp_enqueue_style( 'wonderwall-magazine-style', get_stylesheet_uri(), array(), WONDERWALL_MAGAZINE_THEME_VER );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fonts/font-awesome/font-awesome.css' );
		wp_enqueue_style( 'wonderwall-magazine-plugins', get_template_directory_uri() . '/css/plugins.css' );

		// Scripts
		wp_enqueue_script( 'wonderwall-magazine-plugins-js', get_template_directory_uri() . '/js/plugins.js', array( 'jquery', 'jquery-effects-core' ), WONDERWALL_MAGAZINE_THEME_VER, true );
		wp_enqueue_script( 'wonderwall-magazine-main-js', get_template_directory_uri() . '/js/main.js', array(), WONDERWALL_MAGAZINE_THEME_VER, true );
		wp_localize_script( 'wonderwall-magazine-main-js', 'DDAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		// Google Fonts
		wp_enqueue_style( 'wonderwall-magazine-google-fonts', wonderwall_magazine_fonts_url(), array(), WONDERWALL_MAGAZINE_THEME_VER );

		// Comment reply script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

} add_action( 'wp_enqueue_scripts', 'wonderwall_magazine_scripts' );

if ( ! function_exists( 'wonderwall_magazine_fonts_url' ) ) {

	/**
	 * Returns the google fonts URL
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_fonts_url() {
		
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$font_state = _x( 'on', 'Google fonts: on or off', 'wonderwall-magazine' );
		if ( 'off' !== $font_state ) {
			$font_url = add_query_arg( 'family', urlencode( 'Roboto:300,400,700,400italic|Montserrat:400,700,400italic|Abril Fatface:400,400italic,700|Heebo:400,400italic,700,700italic' ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}

}

if ( ! function_exists( 'wonderwall_magazine_admin_scripts' ) ) {
	
	/**
	 * Enqueue admin scripts and styles
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_admin_scripts() {

		wp_enqueue_style( 'wonderwall-magazine-admin-css', get_template_directory_uri() . '/css/admin.css' );
		wp_enqueue_script( 'wonderwall-magazine-admin-js', get_template_directory_uri() . '/js/admin.js' );

	} 

} add_action( 'admin_enqueue_scripts', 'wonderwall_magazine_admin_scripts' );

// Include TGM Init ( plugin activation )
include get_template_directory() . '/inc/tgm/tgm-init.php';

// Include Frameworks & Options
include get_template_directory() . '/inc/post-options.php';
include get_template_directory() . '/inc/user-options.php';
include get_template_directory() . '/inc/taxonomy-options.php';
include get_template_directory() . '/inc/theme-options.php';
include get_template_directory() . '/inc/importer/init.php';
include get_template_directory() . '/inc/welcome.php';

// Include Other
include get_template_directory() . '/inc/functions.php';
include get_template_directory() . '/inc/display-functions.php';
include get_template_directory() . '/inc/ajax.php';
include get_template_directory() . '/inc/mega-menu.php';

// Include Widgets
include get_template_directory() . '/inc/widgets/widget.author.php';
include get_template_directory() . '/inc/widgets/widget.ad-banner.php';
include get_template_directory() . '/inc/widgets/widget.posts.php';
include get_template_directory() . '/inc/widgets/widget.subscribe.php';
include get_template_directory() . '/inc/widgets/widget.social.php';
include get_template_directory() . '/inc/widgets/widget.instagram.php';
include get_template_directory() . '/inc/widgets/widget.categories.php';

// Yellow Pencil
add_site_option( 'YP_PART_OF_THEME', 'true' );
remove_action( 'admin_init', 'welcome_screen_do_activation_redirect' );

// updates
if ( WONDERWALL_MAGAZINE_SOURCE == 'themeforest' ) {
	include get_template_directory() . '/inc/tf-updates.php';
} else {
	function wonderwall_magazine_theme_updater() {
		require( get_template_directory() . '/inc/mt-updater.php' );
	} add_action( 'after_setup_theme', 'wonderwall_magazine_theme_updater' );
}