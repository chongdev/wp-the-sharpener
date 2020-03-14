<?php
/**
 * Easy Digital Downloads Theme Updater
 */

define( 'MT_UPDATES_REMOTE_API_URL', 'http://meridianthemes.net' );
define( 'MT_UPDATES_ITEM_NAME', 'Wonderwall' );
define( 'MT_UPDATES_THEME_SLUG', 'wonderwall-magazine' );
define( 'MT_UPDATES_AUTHOR', 'MeridianThemes' );
define( 'MT_UPDATES_DOWNLOAD_ID', '494' );

// Includes the files needed for the theme updater
if ( !class_exists( 'Wonderwall_Magazine_Updater_Admin' ) ) {
	include( get_template_directory() . '/inc/mt-updater-admin.php' );
}

// Loads the updater classes
$updater = new Wonderwall_Magazine_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => MT_UPDATES_REMOTE_API_URL,
		'item_name'      => MT_UPDATES_ITEM_NAME,
		'theme_slug'     => MT_UPDATES_THEME_SLUG,
		'version'        => WONDERWALL_MAGAZINE_THEME_VER,
		'author'         => MT_UPDATES_AUTHOR,
		'download_id'    => MT_UPDATES_DOWNLOAD_ID,
		'renew_url'      => '',
		'beta'           => false,
	),

	// Strings
	$strings = array(
		'theme-license'             => esc_html__( 'Theme License', 'wonderwall-magazine' ),
		'enter-key'                 => esc_html__( 'Enter your theme license key.', 'wonderwall-magazine' ),
		'license-key'               => esc_html__( 'License Key', 'wonderwall-magazine' ),
		'license-action'            => esc_html__( 'License Action', 'wonderwall-magazine' ),
		'deactivate-license'        => esc_html__( 'Deactivate License', 'wonderwall-magazine' ),
		'activate-license'          => esc_html__( 'Activate License', 'wonderwall-magazine' ),
		'status-unknown'            => esc_html__( 'License status is unknown.', 'wonderwall-magazine' ),
		'renew'                     => esc_html__( 'Renew?', 'wonderwall-magazine' ),
		'unlimited'                 => esc_html__( 'unlimited', 'wonderwall-magazine' ),
		'license-key-is-active'     => esc_html__( 'License key is active.', 'wonderwall-magazine' ),
		'expires%s'                 => esc_html__( 'Expires %s.', 'wonderwall-magazine' ),
		'expires-never'             => esc_html__( 'Lifetime License.', 'wonderwall-magazine' ),
		'%1$s/%2$-sites'            => esc_html__( 'You have %1$s / %2$s sites activated.', 'wonderwall-magazine' ),
		'license-key-expired-%s'    => esc_html__( 'License key expired %s.', 'wonderwall-magazine' ),
		'license-key-expired'       => esc_html__( 'License key has expired.', 'wonderwall-magazine' ),
		'license-keys-do-not-match' => esc_html__( 'License keys do not match.', 'wonderwall-magazine' ),
		'license-is-inactive'       => esc_html__( 'License is inactive.', 'wonderwall-magazine' ),
		'license-key-is-disabled'   => esc_html__( 'License key is disabled.', 'wonderwall-magazine' ),
		'site-is-inactive'          => esc_html__( 'Site is inactive.', 'wonderwall-magazine' ),
		'license-status-unknown'    => esc_html__( 'License status is unknown.', 'wonderwall-magazine' ),
		'update-notice'             => esc_html__( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'wonderwall-magazine' ),
		'update-available'          => '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',
	)

);
