<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-the-sharpener' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:8888' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'IJ^tq?bQxZIi-;*M=zoxEY6;46_S-Vc!8N1Ss4yr|:cq1j^y_*r4MNCYguZlx5H2' );
define( 'SECURE_AUTH_KEY',  'ugnxS|,9&et/<Uz$5bk<gwF`2r#CUsaQ]{a|G*nI]o=RYL3(.U~=g_|zt96z`.oJ' );
define( 'LOGGED_IN_KEY',    'R.<|JS!TIxc)rK=Pqq>sq$ci5iTJ$F;GQ(yMt9G+6%dp7R}$<euKnmP2tTBN|<0L' );
define( 'NONCE_KEY',        'vw4r@j{a!d*(),g<u^I~%wx=O7DxqZa}g1A#EtJ7FunJJROmU5pwO#kdgTjG_;wy' );
define( 'AUTH_SALT',        '*5C2`;R7c2SUyW%%vUf;JNU0& E)|G*.)v:A=ucFCfp}u+;GZvHT3(5KB#s6IU3l' );
define( 'SECURE_AUTH_SALT', '/mZhd?}HaR]#>GHM`>~gg$DDZ;}{6j12U!nRWj7Bh3nYRUGRiL_m-}UL:UshpOkV' );
define( 'LOGGED_IN_SALT',   'O-Y^YVXndj QDBQxDV:oY`5$HO9p/7$uog_6XdyofuO:dz@CyT].dkkjrdc:8VWC' );
define( 'NONCE_SALT',       'sJSs5.V,U*TnU(ug`L%JaMgognK7}A!qFQ`w!Pmu4fI8rgOG(a nc*PY[8|i,#om' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
