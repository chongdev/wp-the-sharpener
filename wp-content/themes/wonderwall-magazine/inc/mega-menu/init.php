<?php

if ( ! class_exists( 'Wonderwall_Magazine_Mega_Menu_Load_Walker' ) ) :
	
	// class
	class Wonderwall_Magazine_Mega_Menu_Load_Walker {

		// filter
		public static function load() {
			add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_walker' ), 99 );
		}

		// new walker
		public static function _filter_walker( $walker ) {

			$walker = 'Wonderwall_Magazine_Mega_Menu_Walker';
			if ( ! class_exists( $walker ) ) {
				require_once get_template_directory() . '/inc/mega-menu/class.walker.php';
			}

			return $walker;
		}

	}

	// call the class
	add_action( 'wp_loaded', array( 'Wonderwall_Magazine_Mega_Menu_Load_Walker', 'load' ), 9 );

endif;