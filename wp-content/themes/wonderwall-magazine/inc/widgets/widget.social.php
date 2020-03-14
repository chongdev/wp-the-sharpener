<?php

// Register Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "wonderwall_magazine_social_widget" );' ) );

// Widget Class
class Wonderwall_Magazine_Social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'wonderwall_magazine_social_widget', // Base ID
			esc_html__( 'Wonderwall - Social', 'wonderwall-magazine' ), // Name
			array( 'description' => esc_html__( 'Show social links.', 'wonderwall-magazine' ) ) // Args
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

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		?>

			<div class="social-widget">

				<?php if ( wonderwall_magazine_get_theme_mod( 'social_facebook', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link social-link-facebook">
						<span class="social-widget-link-count"><span class="fa fa-facebook"></span><?php echo wonderwall_magazine_get_social_followers_count( 'facebook' ); ?></span>
						<span class="social-widget-link-title"><?php esc_html_e( 'Facebook', 'wonderwall-magazine' ); ?></span>
						<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_facebook', false ) ); ?>" target="_blank"></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_pinterest', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link social-link-pinterest">
						<span class="social-widget-link-count"><span class="fa fa-pinterest"></span><?php echo wonderwall_magazine_get_social_followers_count( 'pinterest' ); ?></span>
						<span class="social-widget-link-title"><?php esc_html_e( 'Pinterest', 'wonderwall-magazine' ); ?></span>
						<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_pinterest', false ) ); ?>" target="_blank"></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_twitter', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link social-link-twitter">
						<span class="social-widget-link-count"><span class="fa fa-twitter"></span><?php echo wonderwall_magazine_get_social_followers_count( 'twitter' ); ?></span>
						<span class="social-widget-link-title"><?php esc_html_e( 'Twitter', 'wonderwall-magazine' ); ?></span>
						<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_twitter', false ) ); ?>" target="_blank"></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_instagram', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link social-link-instagram">
						<span class="social-widget-link-count"><span class="fa fa-instagram"></span><?php echo wonderwall_magazine_get_social_followers_count( 'instagram' ); ?></span>
						<span class="social-widget-link-title"><?php esc_html_e( 'Instagram', 'wonderwall-magazine' ); ?></span>
						<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_instagram', false ) ); ?>" target="_blank"></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>
				<?php if ( wonderwall_magazine_get_theme_mod( 'social_youtube', false ) ) : $has_icons = true; ?>
					<span class="social-widget-link social-link-youtube">
						<span class="social-widget-link-count"><span class="fa fa-youtube-play"></span><?php echo wonderwall_magazine_get_social_followers_count( 'youtube' ); ?></span>
						<span class="social-widget-link-title"><?php esc_html_e( 'Youtube', 'wonderwall-magazine' ); ?></span>
						<a href="<?php echo esc_attr( wonderwall_magazine_get_theme_mod( 'social_youtube', false ) ); ?>" target="_blank"></a>
					</span><!-- .social-widget-link -->
				<?php endif; ?>

			</div><!-- .subscribe-widget -->

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Social Profiles';
		

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<?php esc_html_e( 'The URLs to the social profiles are set in WP admin &rarr; Appearance &rarr; Customize &rarr; Social', 'wonderwall-magazine' ); ?>
		</p>

		<?php 

	}

}