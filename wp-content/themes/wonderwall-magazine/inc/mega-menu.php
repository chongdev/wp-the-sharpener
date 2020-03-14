<?php

require_once get_template_directory() . '/inc/mega-menu/init.php';

/**
 * Add custom options to the navigation menu admin
 *
 * @since 1.0
 */
class Wonderwall_Magazine_Mega_Menu_Options {
	
	// custom fields stored here
	protected static $fields = array();
	
	// initialize
	public static function init() {
			
		// hooks		
		add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );

		// fields
		self::$fields = array(
			'wonderwall-magazine-mega-menu' => esc_html__( 'Mega Menu Category', 'wonderwall-magazine' ),
		);

	}

	// saving custom field values
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {

		// if doing ajax stop
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		// check admin referer
		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		// foreach field
		foreach ( self::$fields as $_key => $label ) {

			$key = sprintf( 'menu-item-%s', $_key );

			// get value
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				$value = $_POST[ $key ][ $menu_item_db_id ];
			} else {
				$value = null;
			}

			// update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			} else {
				delete_post_meta( $menu_item_db_id, $key );
			}

		}

	}
	
	// display fields
	public static function _fields( $id, $item, $depth, $args ) {

		// get categories
		$categories = get_terms( 'category', array( 'hide_empty' => false ) );
		$mega_menu_options = array(
			'disabled' => esc_html__( 'Disabled', 'wonderwall-magazine' ),
		);
		foreach ( $categories as $category ) {
			if ( $category->parent > 0 ) {
				$category->name = '- ' . $category->name;
			}
			$mega_menu_options[$category->term_id] = $category->name;
		}

		// loop through fields
		foreach ( self::$fields as $_key => $label ) :

			// vars
			$key   = sprintf( 'menu-item-%s', $_key );
			$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
			$name  = sprintf( '%s[%s]', $key, $item->ID );
			$value = get_post_meta( $item->ID, $key, true );
			$class = sprintf( 'field-%s', $_key );

			?>
				<p class="description description-wide <?php echo esc_attr( $class ) ?>">

					<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label>

					<select id="<?php echo esc_attr( $id ); ?>" class="widefat <?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">						
						<?php foreach ( $mega_menu_options as $mega_menu_option_key => $mega_menu_option_key_value ) : ?>
							<option value="<?php echo esc_attr( $mega_menu_option_key ); ?>" <?php selected( $value, $mega_menu_option_key ); ?>><?php echo esc_html( $mega_menu_option_key_value ); ?></option>
						<?php endforeach; ?>
					</select>

				</p>
			<?php

		endforeach;
	}
	
	// add the fields to "screen options"
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );
		return $columns;
	}

} Wonderwall_Magazine_Mega_Menu_Options::init();

function wonderwall_magazine_filter_nav_menu_items( $item_output, $item, $depth, $args ) {

	// get post ID
	$post_ID = $item->ID;

	// if not mega menu just return
	$mega_menu_value = get_post_meta( $post_ID, 'menu-item-wonderwall-magazine-mega-menu', true );
	if ( ! $mega_menu_value || $mega_menu_value == 'disabled' ) {
		return $item_output;
	}

	// reset output
	$item_output = '';

	// mega menu html
	$mega_menu_html = '<ul class="sub-menu sub-menu-mega-menu"><li>' . wonderwall_magazine_mega_menu_content( $post_ID ) . '</li></ul>';

	// attributes
	$atts = array();
	$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
	$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
	$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
	$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
	$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
	$attributes = '';
	foreach ( $atts as $attr => $value ) {
		if ( ! empty( $value ) ) {
			$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
			$attributes .= ' ' . $attr . '="' . $value . '"';
		}
	}

	// title
	$title = apply_filters( 'the_title', $item->title, $item->ID );

	// regenerate output
	$item_output = $args->before;
	$item_output .= '<a'. $attributes .'>';
	$item_output .= $args->link_before . $title . $args->link_after;
	$item_output .= '</a>';
	$item_output .= $mega_menu_html;
	$item_output .= $args->after;

	// return 
	return $item_output;

} add_filter( 'walker_nav_menu_start_el', 'wonderwall_magazine_filter_nav_menu_items', 10, 5 );

/**
 * Returns the content for mega menu items
 */
function wonderwall_magazine_mega_menu_content( $post_ID = false ) {

	// return if no post id supplied
	if ( ! $post_ID ) return;

	// get the mega menu category value
	$category = get_post_meta( $post_ID, 'menu-item-wonderwall-magazine-mega-menu', true );

	// return if it has no category value or disabled
	if ( ! $category || $category == 'disabled' ) return;

	// the categories for query
	$categories = array( $category );
	$tabs_nav_items = array( 'All' );
	$tabs_content_items = array();
	$tabs_content_items[$category] = '';
	$tabs_content_items_count[$category] = 0;

	// get the subcategories
	$subcategories = get_terms( 'category', array( 'parent' => $category, 'hide_empty' => false ) );
	
	// add subcategories to query var
	if ( $subcategories ) {
		foreach ( $subcategories as $subcategory ) {
			$tabs_nav_items[] = $subcategory->name;
			$tabs_content_items[$subcategory->term_id] = '';
			$tabs_content_items_count[$subcategory->term_id] = 0;
			$categories[] = $subcategory->term_id;
		}
	}

	// query arguments
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 20,
		'no_found_rows' => true,
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $categories,
			)
		),
	);

	// do the query
	$wonderwall_magazine_query = new WP_Query( $args );

	// column vars
	$max_columns = 3;
	$count = 0;
	$real_count = 0;
	$post_columns = '4';

	// if there are posts
	if ( $wonderwall_magazine_query->have_posts() ) :

		// start posts loop
		while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post();

			// reset output
			$output = '';

			// start output buffer
			ob_start();

				// reset vars
				$post_class_append = '';
				$column_class = '';

				// increase counts
				$count++;
				$real_count++;

				// thumbnail sizes
				$thumb_width = 287;
				$thumb_height = $thumb_width / 1.62;
				$mobile_thumb_height = 480 / 1.62;

				// column class
				$column_class = 'col col-' . $post_columns . ' ';

				// first column
				if ( $count == 1 )
					$post_class_append = 'col-first';

				// last column
				if ( $count >= $max_columns )
					$post_class_append = 'col-last';

				// reset count on max
				if ( $count >= $max_columns )
					$count = 0;

				// post class
				$post_class = $column_class . $post_class_append;

				// set post data
				wonderwall_magazine_set_post_data( array(
					'post_class' => $post_class,
					'thumb_width' => $thumb_width,
					'mobile_thumb_height' => $mobile_thumb_height,
					'thumb_height' => $thumb_height,
				));

				// post template
				get_template_part( 'template-parts/listing/post-s2' );

				// get categories
				$post_categories = get_the_terms( get_the_ID(), 'category' );

			// end output buffer
			$output = ob_get_contents();
			ob_end_clean();

			// store
			foreach ( $post_categories as $post_category ) {
				if ( $tabs_content_items_count[$post_category->term_id] < 3 ) {
					$tabs_content_items[$post_category->term_id] .= $output;
				}
				$tabs_content_items_count[$post_category->term_id]++;
			}

		// end posts loop
		endwhile;

	// end if there are posts
	endif;

	// reset query
	wp_reset_postdata();

	// generate the content
	ob_start(); 
	?>

		<div class="mega-menu-tabs clearfix">

			<div class="mega-menu-tabs-nav col col-2">
				<?php foreach ( $tabs_nav_items as $tabs_nav_item ) : ?>
					<div class="mega-menu-tabs-nav-item">
						<span><?php echo esc_html( $tabs_nav_item ); ?></span><span class="fa fa-angle-right"></span>
					</div><!-- .mega-menu-tabs-nav-item -->
				<?php endforeach; ?>
			</div><!-- .mega-menu-tabs-nav -->

			<div class="mega-menu-tabs-content col col-10 col-last">

				<?php foreach ( $tabs_content_items as $tabs_content_item_key => $tabs_content_item_value ) : ?>
					<div class="mega-menu-tabs-content-item">
						<?php echo do_shortcode( $tabs_content_item_value ); ?>
					</div><!-- .mega-menu-tabs-content-item -->
				<?php endforeach; ?>

			</div><!-- .mega-menu-tabs-content -->

		</div><!-- .mega-menu-tabs -->

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	// pass the output back to the caller
	return $output;

}