<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * Register plugins for TGM
 *
 * @since 1.0
 */
function wonderwall_magazine_register_required_plugins() {
	
	$plugins = array(
		array(
			'name'      => esc_html__( 'CMB2', 'wonderwall-magazine' ),
			'slug'      => 'cmb2',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'Optin Forms', 'wonderwall-magazine' ),
			'slug'      => 'optin-forms',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'Yellow Pencil', 'wonderwall-magazine' ),
			'slug'      => 'waspthemes-yellow-pencil',
			'source'    => get_template_directory() . '/inc/tgm/plugins/waspthemes-yellow-pencil.zip',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'Contact Form 7', 'wonderwall-magazine' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

} add_action( 'tgmpa_register', 'wonderwall_magazine_register_required_plugins' );
