<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "wonderwall_magazine_posts_list_widget" );' ) );
class Wonderwall_Magazine_Posts_List_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'wonderwall_magazine_posts_list_widget', // Base ID
			esc_html__( 'Wonderwall - Posts List', 'wonderwall-magazine' ), // Name
			array( 'description' => esc_html__( 'Show recent or popular posts.', 'wonderwall-magazine' ) ) // Args
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
		
		$amount = $instance['amount'];
		$type = $instance['type'];
		$style = $instance['style'];
		$blog_categories = $instance['blog_categories'];
		$single_behaviour = $instance['single_behaviour'];

		// Order by
		$orderby = 'date';
		if ( $type == 'popular' ) {
			$orderby = 'comment_count';
		} elseif ( $type == 'rand' ) {
			$orderby = 'rand';
		}

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		// vars used
		$count = 0;
		$real_count = 0;
		$post_columns = 12;
		$max_columns = 12 / $post_columns;

		// query arguments
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $amount,
			'orderby' => $orderby
		);

		// blog categories
		if ( $blog_categories !== 'all' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $blog_categories,
				),
			);
		}

		// do the query
		$wonderwall_magazine_query = new WP_Query( $args );

		if ( $wonderwall_magazine_query->have_posts() ) :

			?>

			<div class="posts-list-widget posts-list-widget-style-<?php echo esc_attr( $style ); ?> clearfix">

				<?php if ( $style == '4' ) : ?>

					<div class="carousel-wrapper">

						<div class="carousel" data-items="1">

				<?php endif; ?>

				<?php 

					// start posts loop
					while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post();

						// increase counts
						$count++;
						$real_count++;

						// thumbnail sizes
						if ( $style == 6 ) {
							$thumb_width = 80;
							$thumb_height = 80;
							$mobile_thumb_height = 480;
						} elseif ( $style == 2 ) {
							$thumb_width = 394;
							$thumb_height = $thumb_width / 1.5;
							$mobile_thumb_height = 480 / 1.5;
						} else {
							$thumb_width = 394;
							$thumb_height = $thumb_width / 0.85;
							$mobile_thumb_height = 480 / 0.85;
						}

						// post class
						if ( $style == 4 ) 
							$post_class = 'carousel-item ';
						else 
							$post_class = '';

						// set post data
						wonderwall_magazine_set_post_data( array(
							'post_class' => $post_class,
							'thumb_width' => $thumb_width,
							'mobile_thumb_height' => $mobile_thumb_height,
							'thumb_height' => $thumb_height,
						));

						// post template
						get_template_part( 'template-parts/listing/post-s' . $style );

					// end posts loop
					endwhile; 

				?>

				<?php if ( $style == '4' ) : ?>

						</div><!-- .carousel -->

						<?php if ( $real_count > 1 ) : ?>

							<span class="carousel-nav-prev"><span class="fa fa-angle-left"></span></span>
							<span class="carousel-nav-next"><span class="fa fa-angle-right"></span></span>

						<?php endif; ?>

					</div><!-- .carousel-wrapper -->

				<?php endif; ?>

			</div><!-- .posts-list-widget -->

			<?php

		endif;

		wp_reset_postdata();

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
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['blog_categories'] = strip_tags( $new_instance['blog_categories'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['single_behaviour'] = strip_tags( $new_instance['single_behaviour'] );

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

		// Blog categories
		$blog_categories = get_terms( 'category' );
		$blog_categories_options = array(
			'all' => 'All',
		);
		foreach ( $blog_categories as $blog_category ) {
			$blog_categories_options[$blog_category->term_id] = $blog_category->name;
		}

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Recent Posts';
		if ( isset( $instance[ 'amount' ] ) ) $amount = $instance[ 'amount' ]; else $amount = '4';
		if ( isset( $instance[ 'blog_categories' ] ) ) $blog_categories = $instance[ 'blog_categories' ]; else $blog_categories = 'all';
		if ( isset( $instance[ 'type' ] ) ) $type = $instance[ 'type' ]; else $type = 'recent';
		if ( isset( $instance[ 'style' ] ) ) $style = $instance[ 'style' ]; else $style = '6';
		if ( isset( $instance[ 'single_behaviour' ] ) ) $single_behaviour = $instance[ 'single_behaviour' ]; else $single_behaviour = 'disabled';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php esc_html_e( 'Amount:', 'wonderwall-magazine' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Type:', 'wonderwall-magazine' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>">
				<option <?php if ( $type == 'recent' ) echo 'selected="selected"'; ?> value="recent"><?php esc_html_e( 'Recent', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $type == 'popular' ) echo 'selected="selected"'; ?> value="popular"><?php esc_html_e( 'Popular', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $type == 'rand' ) echo 'selected="selected"'; ?> value="rand"><?php esc_html_e( 'Random', 'wonderwall-magazine' ); ?></option>
			</select>
		</p>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'blog_categories' ) ); ?>"><?php esc_html_e( 'Blog Category:', 'wonderwall-magazine' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'blog_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'blog_categories' ) ); ?>">
				<?php foreach ( $blog_categories_options as $cat_id => $cat_name ) : ?>
					<option <?php if ( $blog_categories == $cat_id ) echo 'selected="selected"'; ?> value="<?php echo esc_attr( $cat_id ); ?>"><?php echo esc_html( $cat_name ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style:', 'wonderwall-magazine' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
				<option <?php if ( $style == '6' ) echo 'selected="selected"'; ?> value="6"><?php esc_html_e( 'Small', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $style == '2' ) echo 'selected="selected"'; ?> value="2"><?php esc_html_e( 'Big', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $style == '4' ) echo 'selected="selected"'; ?> value="4"><?php esc_html_e( 'Carousel', 'wonderwall-magazine' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'single_behaviour' ) ); ?>"><?php esc_html_e( 'Show related posts on single post pages:', 'wonderwall-magazine' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'single_behaviour' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'single_behaviour' ) ); ?>">
				<option <?php if ( $single_behaviour == 'disabled' ) echo 'selected="selected"'; ?> value="disabled"><?php esc_html_e( 'Disabled', 'wonderwall-magazine' ); ?></option>
				<option <?php if ( $single_behaviour == 'enabled' ) echo 'selected="selected"'; ?> value="enabled"><?php esc_html_e( 'Enabled', 'wonderwall-magazine' ); ?></option>
			</select>
		</p>
		<?php 

	}

}