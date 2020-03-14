<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "wonderwall_magazine_ad_banner_widget" );' ) );

// Widget Class
class Wonderwall_Magazine_Ad_Banner_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'wonderwall_magazine_ad_banner_widget', // Base ID
			esc_html__( 'Wonderwall - Advertisement Banner', 'wonderwall-magazine' ), // Name
			array( 'description' => esc_html__( 'Show an advertisement banner.', 'wonderwall-magazine' ) ) // Args
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
		
		// Options
		$banner_image = $instance['banner_image'];
		$banner_url = $instance['banner_url'];
		
		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		?>

			<div class="banner-widget text-align-center">
					
				<?php if ( $banner_image !== '' ) : ?>
					<a href="<?php echo esc_url( $banner_url ); ?>" target="_blank" rel="nofollow"><img src="<?php echo esc_attr( $banner_image ); ?>" alt="" /></a>
				<?php endif; ?>

			</div><!-- .banner-widget -->

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
			
		$instance['banner_image'] = strip_tags( $new_instance['banner_image'] );
		$instance['banner_url'] = strip_tags( $new_instance['banner_url'] );
		

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Advertisement';
		if ( isset( $instance[ 'banner_image' ] ) ) $banner_image = $instance[ 'banner_image' ]; else $banner_image = '';
		if ( isset( $instance[ 'banner_url' ] ) ) $banner_url = $instance[ 'banner_url' ]; else $banner_url = '';
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_image' ) ); ?>"><?php esc_html_e( 'Banner Image URL:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'banner_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'banner_image' ) ); ?>" type="text" value="<?php echo esc_attr( $banner_image ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_url' ) ); ?>"><?php esc_html_e( 'Banner Link URL:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'banner_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'banner_url' ) ); ?>" type="text" value="<?php echo esc_attr( $banner_url ); ?>" />
		</p>

		<?php 

	}

}