<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "wonderwall_magazine_categories_widget" );' ) );

// Widget Class
class Wonderwall_Magazine_Categories_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'wonderwall_magazine_categories_widget', // Base ID
			esc_html__( 'Wonderwall - Categories', 'wonderwall-magazine' ), // Name
			array( 'description' => esc_html__( 'Show listing of categories.', 'wonderwall-magazine' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$show_count = $instance['show_count'];
		$show_image = $instance['show_image'];

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		$categories = get_terms( 'category' );
		?>

			<div class="categories-widget">
				<?php foreach ( $categories as $category ) : ?>
					<?php
						$style = '';
						$image = false;
						if ( $show_image == 'enabled' ) {
							
							if ( get_option( 'dd_category_meta' ) ) {
								$tags_meta = get_option( 'dd_category_meta' );
								$tag_ID = $category->term_id;
								if ( isset( $tags_meta[$tag_ID] ) ) {
									$image = $tags_meta[$tag_ID]['dd_category_img'];
								}
							}

							if ( $image ) {
								$style = 'background-image:url(' . $image . ')';
							}

						}
					?>
					<div class="categories-widget-category <?php if ( $image ) echo 'categories-widget-category-has-image'; ?>">
						<?php if ( $image ) : ?>
							<span class="categories-widget-category-image" style="<?php echo esc_attr( $style ); ?>"></span>
						<?php endif; ?>
						<span class="categories-widget-category-title"><?php echo esc_html( $category->name ); ?></span>
						<?php if ( $show_count == 'enabled' ) : ?>
							<span class="categories-widget-category-count"><?php echo esc_html( $category->count ) . ' '; esc_html_e( 'Posts', 'wonderwall-magazine' ); ?></span>
						<?php endif; ?>
						<a href="<?php echo get_term_link( $category, 'category' ) ?>" class="categories-widget-category-link"></a>
					</div><!-- .categories-widget-category -->
				<?php endforeach; ?>
			</div><!-- .categories-widget -->

		<?php

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_count'] = strip_tags( $new_instance['show_count'] );
		$instance['show_image'] = strip_tags( $new_instance['show_image'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Categories';
		if ( isset( $instance[ 'show_count' ] ) ) $show_count = $instance[ 'show_count' ]; else $show_count = 'enabled';
		if ( isset( $instance[ 'show_image' ] ) ) $show_image = $instance[ 'show_image' ]; else $show_image = 'enabled';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php esc_html_e( 'Show posts count:', 'wonderwall-magazine' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>">
				<option <?php if ( $show_count == 'disabled' ) echo 'selected="selected"'; ?> value="disabled"><?php esc_html_e( 'Disabled', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $show_count == 'enabled' ) echo 'selected="selected"'; ?> value="enabled"><?php esc_html_e( 'Enabled', 'wonderwall-magazine' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php esc_html_e( 'Show background image:', 'wonderwall-magazine' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_image' ) ); ?>">
				<option <?php if ( $show_image == 'disabled' ) echo 'selected="selected"'; ?> value="disabled"><?php esc_html_e( 'Disabled', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $show_image == 'enabled' ) echo 'selected="selected"'; ?> value="enabled"><?php esc_html_e( 'Enabled', 'wonderwall-magazine' ); ?></option>
			</select>
		</p>
		<?php 

	}

}