<?php

function wonderwall_magazine_view_count_increment_ajax( $atts ) {

	// The array we'll pass back to the AJAX call
	$response = array();

	// The code of the template
	$postID = stripslashes( $_POST['dd_post_id'] );

	// Increment the count
	wonderwall_magazine_view_count_increment( $postID );

	// Bye bye
	exit;

} add_action( 'wp_ajax_wonderwall-magazine-increment-viewcount', 'wonderwall_magazine_view_count_increment_ajax' ); add_action( 'wp_ajax_nopriv_wonderwall-magazine-increment-viewcount', 'wonderwall_magazine_view_count_increment_ajax' );