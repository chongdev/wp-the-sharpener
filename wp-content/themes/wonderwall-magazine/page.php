<?php get_header(); ?>

<?php
	
	// the layout
	$layout = 'no_sidebar';
	if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'layout' ) ) {
		$layout = wonderwall_magazine_get_post_meta( get_the_ID(), 'layout' );
	}

	// element classes
	$content_class = '';
	if ( $layout == 'left_sidebar' ) {
		$content_class = 'col col-8 col-last float-right';
	} elseif ( $layout == 'right_sidebar' ) {
		$content_class = 'col col-8';
	}

?>
	
	<div class="wrapper clearfix">

		<?php global $post; if ( '' !== $post->post_content ) : ?>

			<section id="content" class="<?php echo esc_attr( $content_class ); ?>">

				<?php

					// Loop posts
					while ( have_posts() ) : the_post();

						// Output from template
						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( wonderwall_magazine_get_theme_mod( 'comments', 'enabled' ) == 'enabled' ) {
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						}

					endwhile;
				?>			

			</section><!-- #content -->

		<?php endif; ?>

		<?php 
			// get sidebar
			if ( $layout == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $layout == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		?>

	</div><!-- .wrapper -->

<?php get_footer();
