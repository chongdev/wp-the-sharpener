<?php

/**
 * Table Of Contents
 *
 * Wonderwall_Magazine_Aq_resize ( Image resizing class )
 * wonderwall_magazine_aq_resize ( Image resizing function )
 * wonderwall_magazine_post_thumbnail ( Post thumbnail with resizing )
 * wonderwall_magazine_get_social_count ( Returns amount of social shares a page has )
 * wonderwall_magazine_get_theme_mod ( Returns customizer option value )
 * wonderwall_magazine_get_post_meta ( Returns post meta value )
 * wonderwall_magazine_has_page_sections ( Check if page has page sections )
 * wonderwall_magazine_get_page_sections ( Get page sections )
 * wonderwall_magazine_get_thumbnail_sizes ( Get thumbnail sizes )
 * wonderwall_magazine_body_class ( Add new classes to body )
 * wonderwall_magazine_get_attachment_alt ( Returns the alt attribute for an attachment )
 * wonderwall_magazine_get_header_style ( Returns the header style )
 * wonderwall_magazine_get_social_followers_count ( get followers count )
 * wonderwall_get_instagram_images
 * wonderwall_magazine_view_count_increment
 */

if( ! class_exists('Wonderwall_Magazine_Aq_Resize') ) {

	/**
	 * Image resizing class
	 *
	 * @since 1.0
	 */
	class Wonderwall_Magazine_Aq_Resize {

		/**
		 * The singleton instance
		 */
		static private $instance = null;

		/**
		 * No initialization allowed
		 */
		private function __construct() {}

		/**
		 * No cloning allowed
		 */
		private function __clone() {}

		/**
		 * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
		 */
		static public function getInstance() {
			if(self::$instance == null) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Run, forest.
		 */
		public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = true ) {

			// Validate inputs.
			if ( ! $url || ( ! $width && ! $height ) ) return false;

			$upscale = true;

			// Caipt'n, ready to hook.
			if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

			// Define upload path & dir.
			$upload_info = wp_upload_dir();
			$upload_dir = $upload_info['basedir'];
			$upload_url = $upload_info['baseurl'];
			
			$http_prefix = "http://";
			$https_prefix = "https://";
			
			/* if the $url scheme differs from $upload_url scheme, make them match 
			   if the schemes differe, images don't show up. */
			if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
				$upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
			}
			elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
				$upload_url = str_replace($https_prefix,$http_prefix,$upload_url);      
			}
			

			// Check if $img_url is local.
			if ( false === strpos( $url, $upload_url ) ) return false;

			// Define path of image.
			$rel_path = str_replace( $upload_url, '', $url );
			$img_path = $upload_dir . $rel_path;

			// Check if img path exists, and is an image indeed.
			if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

			// Get image info.
			$info = pathinfo( $img_path );
			$ext = $info['extension'];
			list( $orig_w, $orig_h ) = getimagesize( $img_path );

			// Get image size after cropping.
			$dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
			$dst_w = $dims[4];
			$dst_h = $dims[5];

			// Return the original image only if it exactly fits the needed measures.
			if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
				$img_url = $url;
				$dst_w = $orig_w;
				$dst_h = $orig_h;
			} else {
				// Use this to check if cropped image already exists, so we can return that instead.
				$suffix = "{$dst_w}x{$dst_h}";
				$dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
				$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

				if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
					// Can't resize, so return false saying that the action to do could not be processed as planned.
					return $url;
				}
				// Else check if cache exists.
				elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
					$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
				}
				// Else, we resize the image and return the new resized image url.
				else {

					$editor = wp_get_image_editor( $img_path );

					if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
						return $url;

					$resized_file = $editor->save();

					if ( ! is_wp_error( $resized_file ) ) {
						$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
						$img_url = $upload_url . $resized_rel_path;
					} else {
						return $url;
					}

				}
			}

			// Okay, leave the ship.
			if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

			// Return the output.
			if ( $single ) {
				// str return.
				$image = $img_url;
			} else {
				// array return.
				$image = array (
					0 => $img_url,
					1 => $dst_w,
					2 => $dst_h
				);
			}

			return $image;
		}

		/**
		 * Callback to overwrite WP computing of thumbnail measures
		 */
		function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
			if ( ! $crop ) return null; // Let the wordpress default function handle this.

			// Here is the point we allow to use larger image size than the original one.
			$aspect_ratio = $orig_w / $orig_h;
			$new_w = $dest_w;
			$new_h = $dest_h;

			if ( ! $new_w ) {
				$new_w = intval( $new_h * $aspect_ratio );
			}

			if ( ! $new_h ) {
				$new_h = intval( $new_w / $aspect_ratio );
			}

			$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

			$crop_w = round( $new_w / $size_ratio );
			$crop_h = round( $new_h / $size_ratio );

			$s_x = floor( ( $orig_w - $crop_w ) / 2 );
			$s_y = floor( ( $orig_h - $crop_h ) / 2 );

			return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
		}

	}
	
}


if ( ! function_exists('wonderwall_magazine_aq_resize') ) {

	/**
	 * Resize an image using Wonderwall_Magazine_Aq_Resize Class
	 *
	 * @since 1.0
	 *
	 * @param string $url     The URL of the image
	 * @param int    $width   The new width of the image
	 * @param int    $height  The new height of the image
	 * @param bool   $crop    To crop or not to crop, the question is now
	 * @param bool   $single  If true only returns the URL, if false returns array
	 * @param bool   $upscale If image not big enough for new size should it upscale
	 * @return mixed If $single is true return new image URL, if it is false return array
	 *               Array contains 0 = URL, 1 = width, 2 = height
	 */
	function wonderwall_magazine_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {

		 if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {

			$args = array(
				'resize' => "$width,$height"
			);
			if ( $single == true ) {
				return jetpack_photon_url( $url, $args );
			} else {
				$image = array (
					0 => $img_url,
					1 => $width,
					2 => $height
				);
				return jetpack_photon_url( $url, $args );
			}

		} else {

			$aq_resize = Wonderwall_Magazine_Aq_Resize::getInstance();
			return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
			
		}

	}

}

if ( ! function_exists( 'wonderwall_magazine_the_post_thumbnail' ) ) {

	/**
	 * Post thumbnail with resizing
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_the_post_thumbnail( $width = 500, $height = 500, $crop = true, $mobile_width = 480, $mobile_height = false, $mobile_force = false ) {

		if ( $height > 2000 ) {
			$crop = false;
		}

		if ( get_the_ID() ) {
			
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
			$image_url = $image_url[0];
			$alt = wonderwall_magazine_get_attachment_alt( get_post_thumbnail_id( get_the_ID() ) ); 

			// Mobile version
			$thumb_mobile_version = '';
			if ( $mobile_height && ( $mobile_width > $width || $mobile_force ) ) {
				$thumb_mobile_version = wonderwall_magazine_aq_resize( $image_url, $mobile_width, $mobile_height, $crop );
			}

			echo '<img data-mobile-version="' . esc_attr( $thumb_mobile_version ) . '" src="' . wonderwall_magazine_aq_resize( $image_url, $width, $height, $crop ) . '" alt="'. esc_attr( $alt ) .'" />';
		} else {
			echo '';
		}

	}

}

/**
 * Returns amount of social shares a page has
 *
 * @since 1.0
 *
 * @param int     $post_ID ID of the post/page. Default false, uses get_the_ID()
 * @param int     $refresh_in Amount of seconds for cached info to be stored. Default 3600.
 * @return array  Array containing amount of shares. Keys are fb, twitter and pinterest. 
 */
function wonderwall_magazine_get_social_count( $post_ID = false, $refresh_in = 3600 ) {

	// If ID nt supplied use current
	if ( $post_ID == false ) {
		$post_ID = get_the_ID();
	}	

	// Transient
	$transient_id = 'wonderwall_magazine_social_shares_count_' . $post_ID;

	if ( false === ( $share_info = get_transient( $transient_id ) ) ) {

		$the_url = get_permalink( $post_ID );

		// Defaults
		$share_info = array(
			'fb' => 0,
			'twitter' => 0,
			'pinterest' => 0,
			'total' => 0,
		);

		// Facebook
		$fb_get = wp_remote_get( 'http://graph.facebook.com/?id=' . $the_url );
		$fb_count = 0;
		if ( is_array( $fb_get ) ) {
			$fb_get_body = json_decode( $fb_get['body'] );
			if ( isset( $fb_get_body->shares ) ) {
				$fb_count = $fb_get_body->shares;
			} else {
				$fb_count = 0;
			}
			$share_info['fb'] = $fb_count;
		}

		// Twitter									
		$twitter_get = wp_remote_get( 'http://cdn.api.twitter.com/1/urls/count.json?url=' . $the_url );
		$twitter_count = 0;
		if ( is_array( $twitter_get ) ) {
			$twitter_get_body = json_decode( $twitter_get['body'] );
			if ( isset( $twitter_get_body->count ) ) {
				$twitter_count = $twitter_get_body->count;
			} else {
				$twitter_count = 0;
			}
			$share_info['twitter'] = $twitter_count;
		}

		// Pinterest 
		$pinterest_get = wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?url=' . $the_url );
		$pinterest_count = 0;
		if ( is_array( $pinterest_get ) ) {
			$pinterest_get_body = json_decode( preg_replace('/^receiveCount\((.*)\)$/', "\\1", $pinterest_get['body'] ) );
			if ( isset( $pinterest_get_body->count ) ) {
				$pinterest_count = $pinterest_get_body->count;
			} else {
				$pinterest_count = 0;
			}
			$share_info['pinterest'] = $pinterest_count;
		}

		$share_info['total'] = $fb_count + $twitter_count + $pinterest_count;

		// Check if there is data
		if ( isset( $share_info ) ) {
			set_transient( $transient_id, $share_info, $refresh_in );											
		} else {
			$share_info = false;
		}

	}

	// Pass the data back
	$share_info = apply_filters( 'wonderwall_magazine_social_count', $share_info );

	// over 1000 use 1K
	if ( $share_info['total'] >= 1000 ) {
		$share_info['total'] = round( $share_info['total'] / 1000, 1 ) . 'K';
	}

	return $share_info;

}

/**
 * Returns customizer option value
 *
 * @since 1.0
 */
function wonderwall_magazine_get_theme_mod( $option_id, $default = '' ) {

	$return = get_theme_mod( WONDERWALL_MAGAZINE_CUSTOMIZER_PREPEND . $option_id, $default );
	if ( $return == '' ) { $return = $default; }

	return $return;

}

/**
 * Returns post meta value
 *
 * @since 1.0
 */
function wonderwall_magazine_get_post_meta( $post_id, $option_id ) {

	$option_id = '_wonderwall_magazine_' . $option_id;

	return get_post_meta( $post_id, $option_id , true );

}

/**
 * Check if page has sections
 *
 * @since 1.0
 */
function wonderwall_magazine_has_page_sections( $postID = false ) {

	// If no ID get the ID
	if ( ! $postID )
		$postID = get_the_ID();

	// If still no ID return false
	if ( ! $postID )
		return false;

	// If has images return true, otherwise false
	if ( wonderwall_magazine_get_post_meta( $postID, 'home_sections' ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Get page sections
 * 
 * @since 1.0
 */
function wonderwall_magazine_get_page_sections( $postID = false ) {

	// If no ID get the ID
	if ( ! $postID )
		$postID = get_the_ID();

	// If still no ID return
	if ( ! $postID )
		return;

	// If post has gallery meta return true
	if ( wonderwall_magazine_get_post_meta( $postID, 'home_sections' ) ) {
		
		return wonderwall_magazine_get_post_meta( $postID, 'home_sections' );

	// Otherwise return false
	} else {
		return false;
	}

}

/**
 * Get thumbnail sizes
 * 
 * @since 1.0
 */
function wonderwall_magazine_get_thumbnail_sizes( $layout = 'full_content', $columns = '4', $post_type = 'post' ) {

	// Get width
	if ( $layout == 'full_content' ) {
		if ( $columns == '12' )
			$width = 1100;
		elseif ( $columns == '6' )
			$width = 527;
		else
			$width = 527; // 341
	} elseif ( $layout == 'content_sidebar' ) {
		if ( $columns == '12' )
			$width = 712;
		elseif ( $columns == '6' )
			$width = 527; // 341
		else
			$width = 527; // 217
	}

	// Get height
	if ( $post_type == 'post' ) {
		$height = $width / 2;
	} elseif ( $post_type == 'mrdt_classes' ) {
		$height = $width / 2;
	} elseif( $post_type == 'mrdt_trainers' ) {
		$height = $width / 2;
	} else {
		$height = $width / 2;
	}

	if ( $layout == 'featured-1' ) {
		$width = 527;
		$height = 595;
	} elseif ( $layout == 'featured-2' ) {
		$width = 527;
		$height = 340;
	}

	// Crop
	$crop = true;

	return array( 
		'width' => $width, 
		'height' => $height,
		'crop' => $crop
	);

}

/**
 * Add new classes to body
 *
 * @since 1.0
 */
function wonderwall_magazine_body_class( $classes ) {

	// header style
	$header_style = wonderwall_magazine_get_header_style();
	$classes[] = 'body-header-style-' . $header_style;

	if ( is_singular( array( 'post', 'page' ) ) ) {

		$tagline_bg_image = false;
		if ( has_post_thumbnail( get_the_ID() ) || wonderwall_magazine_get_post_meta( get_the_ID(), 'tagline_bg_image' ) ) {
			$tagline_bg_image = true;
		}

		if ( $tagline_bg_image ) {
			$classes[] = 'body-tagline-has-bg-image';
		}

	}

	// featured
	$featured = false;

	// If page
	if ( is_page() ) {

		// Page ID
		$pageID = get_the_ID();

		// Get value of featured option
		$featured_type = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_type' );

		// If set and not disabled
		if ( $featured_type && $featured_type !== 'disabled' ) {
			$featured = true;
		}

	}

	// class for featured
	if ( $featured ) {
		$classes[] = 'body-has-featured-' . $featured_type;
	}

	// sticky top bar
	$classes[] = 'body-top-bar-sticky-' . wonderwall_magazine_get_theme_mod( 'top_bar_sticky_state', 'disabled' );

	// social sharing
	$classes[] = 'body-social-sharing-' . wonderwall_magazine_get_theme_mod( 'social_sharing', 'enabled' );

	// featured image
	$classes[] = 'body-featured-image-' . wonderwall_magazine_get_theme_mod( 'featured_image_state', 'enabled' );

	// Pass it back to WP
	return $classes;

} add_filter( 'body_class','wonderwall_magazine_body_class' );

/**
 * Returns the ALT attribute for an attachment
 *
 * @since 1.0
 *
 * @param string   $attachment_ID The ID of the attachment
 * @return string  The ALT attribute text
 */
function wonderwall_magazine_get_attachment_alt( $attachment_ID ) {

	// Get ALT
	$thumb_alt = trim( strip_tags( get_post_meta( $attachment_ID, '_wp_attachment_image_alt', true) ) );
	
	if ( empty( $thumb_alt ) )
		$thumb_alt = '';

	/*
	// No ALT supplied get attachment info
	if ( empty( $thumb_alt ) )
		$attachment = get_post( $attachment_ID );
	
	// Use caption if no ALT supplied
	if ( empty( $thumb_alt ) )
		$thumb_alt = trim(strip_tags( $attachment->post_excerpt ));
	
	// Use title if no caption supplied either
	if ( empty( $thumb_alt ) )
		$thumb_alt = trim(strip_tags( $attachment->post_title ));
	*/

	// Return ALT
	return esc_attr( $thumb_alt );

}

/**
 * Returns the header style value
 *
 * @since 1.0
 */
function wonderwall_magazine_get_header_style( $postID = false ) {

	// if id not supplied but it is singular get the ID
	if ( $postID == false && is_singular() ) {
		$postID = get_the_ID();
	}

	// get the local value
	$local_value = wonderwall_magazine_get_post_meta( $postID, 'header_style' );

	// get the global value
	$global_value = wonderwall_magazine_get_theme_mod( 'header_style', 'light-v1' );

	// return
	if ( ! $local_value || $local_value == 'default' )
		return $global_value;
	else
		return $local_value;


}

function wonderwall_magazine_get_section_info() {

	global $wonderwall_magazine_home_section;

	if ( ! isset( $wonderwall_magazine_home_section['spacing'] ) ) {
		$wonderwall_magazine_home_section['spacing'] = 'enabled';
	}

	if ( ! isset( $wonderwall_magazine_home_section['section_title'] ) || $wonderwall_magazine_home_section['section_title'] == '' ) {
		$wonderwall_magazine_home_section['section_title'] = false;
	}

	if ( ! isset( $wonderwall_magazine_home_section['section_title_url'] ) || $wonderwall_magazine_home_section['section_title_url'] == '' ) {
		$wonderwall_magazine_home_section['section_title_url'] = false;
	}	

	if ( ! isset( $wonderwall_magazine_home_section['sticky_sidebar'] ) || $wonderwall_magazine_home_section['sticky_sidebar'] == 'default' ) {
		$wonderwall_magazine_home_section['sticky_sidebar'] = wonderwall_magazine_get_theme_mod( 'sticky_sidebar_homepage', 'enabled' );
	}

	return $wonderwall_magazine_home_section;

}

function wonderwall_magazine_set_section_info( $value ) {

	global $wonderwall_magazine_home_section;
	$wonderwall_magazine_home_section = $value;

}

function wonderwall_magazine_get_post_class() {

	global $wonderwall_magazine_post_class;
	return $wonderwall_magazine_post_class;

}

function wonderwall_magazine_set_post_class( $value ) {

	global $wonderwall_magazine_post_class;
	$wonderwall_magazine_post_class = $value;

}

function wonderwall_magazine_get_thumb_sizes() {

	global $wonderwall_magazine_thumb_resize;
	return $wonderwall_magazine_thumb_resize;

}

function wonderwall_magazine_set_thumb_sizes( $value ) {

	global $wonderwall_magazine_thumb_resize;
	$wonderwall_magazine_thumb_resize = $value;

}

function wonderwall_magazine_get_page_by_template( $template_name ) {
    
    global $wpdb;
	$page_ID = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value = %s", $template_name ) );
	if ( is_numeric( $page_ID ) ) {
		return $page_ID;
	} else {
		return false;
	}

}

/**
 * get social followers count
 */
function wonderwall_magazine_get_social_followers_count( $social, $username = '' ) {

	// default to false
	$followers = false;
	$update_transient = false;
	$update_transient_interval = 60 * 60 * 12;

	// twitter
	if ( $social == 'twitter' ) {

		$transient_id = 'wonderwall_magazine_social_shares_followers_twitter';

		if ( false === ( $followers = get_transient( $transient_id ) ) ) {

			// if the info is set
			if ( wonderwall_magazine_get_theme_mod( 'social_twitter_username', false ) ) {

				$update_transient = true;
				$twitter_data = wp_remote_get( 'https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=' . wonderwall_magazine_get_theme_mod( 'social_twitter_username' ) );
				$twitter_data = json_decode( $twitter_data['body'] );
				if ( isset( $twitter_data[0]->followers_count ) ) {
					$followers = $twitter_data[0]->followers_count;
				}			

			}

		}

	// instagram
	} elseif ( $social == 'instagram' ) {

		$transient_id = 'wonderwall_magazine_social_shares_followers_instagram';

		if ( false === ( $followers = get_transient( $transient_id ) ) ) {

			// if the info is set
			if ( wonderwall_magazine_get_theme_mod( 'social_instagram_access_token', false ) ) {

				$update_transient = true;

				// acces token
				$access_token = wonderwall_magazine_get_theme_mod( 'social_instagram_access_token', false );
				
				// get data
				if ( $access_token ) {

					// get data
					$url = 'https://api.instagram.com/v1/users/self/?access_token=' . $access_token;
					$data = json_decode( wp_remote_retrieve_body( wp_remote_get( $url, array( 'timeout' => 30 ) ) ), true );		

					// check if there is data
					if ( isset( $data['data'] ) ) {
						$followers = $data['data']['counts']['followed_by'];
					}

				}

			}

		}

	// facebook
	} elseif ( $social == 'facebook' ) {

		$transient_id = 'wonderwall_magazine_social_shares_followers_facebook';

		if ( false === ( $followers = get_transient( $transient_id ) ) ) {

			// if the info is set
			if ( wonderwall_magazine_get_theme_mod( 'social_facebook_page_id', false ) ) {

				$update_transient = true;

				$fb_get = wp_remote_get( 'https://graph.facebook.com/' . wonderwall_magazine_get_theme_mod( 'social_facebook_page_id' ) . '/?fields=fan_count&access_token=' . wonderwall_magazine_get_theme_mod( 'social_facebook_app_id' ) . '|' . wonderwall_magazine_get_theme_mod( 'social_facebook_app_secret' ) );
				$fb_count = 0;
				if ( is_array( $fb_get ) ) {
					$fb_get_body = json_decode( $fb_get['body'] );
					if ( isset( $fb_get_body->fan_count ) ) {
						$followers = $fb_get_body->fan_count;
					}
				}

			}

		}

	// pinterest 
	} elseif ( $social == 'pinterest' ) {
		
		$transient_id = 'wonderwall_magazine_social_shares_followers_pinterest';

		if ( false === ( $followers = get_transient( $transient_id ) ) ) {

			// if the info is set
			if ( wonderwall_magazine_get_theme_mod( 'social_pinterest_username', false ) ) {

				$update_transient = true;

				// get pinterest
				$pinterest_get = wp_remote_get( 'https://www.pinterest.com/' . wonderwall_magazine_get_theme_mod( 'social_pinterest_username' ), array( 'timeout' => 60 ) );

				// if no errors proceed
				if ( ! is_wp_error( $pinterest_get ) ) {

					if ( 200 == $pinterest_get['response']['code'] ) {
						
						// get the count
						$tags = array();
						$regex = '/property\=\"pinterestapp:followers\" name\=\"pinterestapp:followers\" content\=\"(.*?)" data-app/';
						preg_match( $regex, $pinterest_get['body'], $tags );
						if ( isset( $tags[1] ) ) {
							$followers = intval( $tags[1] );
						}

					}

				}

			}

		}

	} elseif ( $social == 'youtube' ) {

		$followers = wonderwall_magazine_get_theme_mod( 'social_youtube_count', false );

	}

	// if getting the count was not succesful get backup
	if ( ! $followers ) {

		// get backup data
		$followers_backup = get_option( 'wonderwall_magazine_social_followers', false );

		// if no backup data just return
		if ( ! $followers_backup ) return;

		// get the backup
		if ( isset( $followers_backup[$social] ) )
			$followers = $followers_backup[$social];		

	} else {

		// update the transint for this social site
		if ( $update_transient )
			set_transient( $transient_id, $followers, $update_transient_interval );

	}	

	// if still no followers just retun
	if ( ! $followers ) {
		return;
	}

	// store new followers backup
	$followers_backup = get_option( 'wonderwall_magazine_social_followers', array() );
	$followers_backup[$social] = $followers;
	update_option( 'wonderwall_magazine_social_followers', $followers_backup );

	// the append ( followers/likes/fans )
	$followers_append = esc_html__( 'Followers', 'wonderwall-magazine' );
	if ( $social == 'facebook' )
		$followers_append = esc_html__( 'Likes', 'wonderwall-magazine' );

	// over 1000 use 1K
	if ( $followers >= 1000 ) {
		$followers = round( $followers / 1000, 1 ) . 'K';
	}

	// return
	return $followers . ' ' . $followers_append;

}

/**
 * Get post data
 */
function wonderwall_magazine_get_post_data() {

	global $wonderwall_magazine_post_data;
	return $wonderwall_magazine_post_data;

}

/**
 * Set post data
 */
function wonderwall_magazine_set_post_data( $value ) {

	global $wonderwall_magazine_post_data;
	$wonderwall_magazine_post_data = $value;

}

/**
 * Returns images from instagra account
 *
 * @since 1.0
 */
function wonderwall_magazine_get_instagram_images( $username = '17395902', $amount = 20 ) {

	//Options to pass to JS file
	$access_token = wonderwall_magazine_get_theme_mod( 'footer_instagram_access_token', false );
	if ( ! $access_token ) {
		return false;
	}

	// Get username
	$username = '';
	if ( $access_token && $access_token !== '' ) {
		$username = explode( '.', $access_token );
		$username = $username[0];
	}

	$transient_id = 'wonderwall_magazine_instagram_transient_' . $username;

	if ( false === ( $images = get_transient( $transient_id ) ) ) {

		$args = array(
			'timeout'     => 30,
		);

		// Get Images
		$url = 'https://api.instagram.com/v1/users/' . $username . '/media/recent/?access_token=' . $access_token . '&count=' . $amount;
		$data = json_decode( wp_remote_retrieve_body( wp_remote_get( $url, $args ) ), true );

		// Check if images are returned
		if ( isset( $data['data'] ) ) {
			
			$images_data = $data['data'];
			$images = array();

			// Generate array
			foreach ( $images_data as $image ) {

				$images[] = array(
					'image' => $image['images']['thumbnail']['url'],
					'url' => $image['link'],
				);

			}

			// Set Trainsient
			set_transient( $transient_id, $images, 12 * HOUR_IN_SECONDS );

		} else {
			$images = false;
		}

	}

	return $images;

}

/**
 * Increment Count
 *
 * Stored in post meta. viewed_count for total, viewed_count_daily for today, _daily_date for current date.
 * 
 * @since 1.0
 */
function wonderwall_magazine_view_count_increment( $post_id = false ) {

	// if ID not supplied get the ID
	if ( ! $post_id ) 
		$post_id = get_the_ID();

	// if still no ID give up
	if ( ! $post_id )
		return;

	/**
	 * Total Count
	 */

	// Current total count
	$current_count = 0;
	if ( get_post_meta( $post_id, 'dd_viewed_count', true ) ) {
		$current_count = get_post_meta( $post_id, 'dd_viewed_count', true );
	}

	// Increase and update total count
	$current_count++;
	update_post_meta( $post_id, 'dd_viewed_count', $current_count );		

	/**
	 * Current Day Count
	 */

	// Current day count
	$current_day = date( 'Y-m-d', current_time( 'timestamp' ) );
	$daily_count = 0;
	if ( get_post_meta( $post_id, 'dd_viewed_count_daily', true ) ) {
		$daily_count = get_post_meta( $post_id, 'dd_viewed_count_daily', true );
	}

	// Stored day
	$current_stored_day = $current_day;
	if ( get_post_meta( $post_id, '_dd_daily_date', true ) ) {
		$current_stored_day = get_post_meta( $post_id, '_dd_daily_date', true );
	} else {
		update_post_meta( $post_id, '_dd_daily_date', $current_day );
	}

	// If current day is equal to current stored date increment
	if ( $current_stored_day == $current_day ) {
		$daily_count++;
		update_post_meta( $post_id, 'dd_viewed_count_daily', $daily_count );		
	// If not set count back to 1 and update the current stored day
	} else {
		update_post_meta( $post_id, 'dd_viewed_count_daily', 1 );		
		update_post_meta( $post_id, '_dd_daily_date', $current_day );
	}

	return;

}