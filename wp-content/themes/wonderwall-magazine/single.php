<?php get_header(); ?>
		
	<div class="wrapper clearfix">

		<?php

			// type
			$type = 'regular';
			if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'post_type' ) ) {
				$type = wonderwall_magazine_get_post_meta( get_the_ID(), 'post_type' );
			}

			// the layout
			$layout = 'right_sidebar';
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

		<?php if ( $type == 'regular' ) : ?>

			<section id="content" class="<?php echo esc_attr( $content_class ); ?> single-content">

				<?php

					// start loop posts
					while ( have_posts() ) : the_post();

						// output content
						get_template_part( 'template-parts/content-single', get_post_format() );

						// Output about author
						get_template_part( 'template-parts/main/about-author' );

						// output prev/next posts
						get_template_part( 'template-parts/main/adjacent-posts' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( wonderwall_magazine_get_theme_mod( 'comments', 'enabled' ) == 'enabled' ) {
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						}

					// end loop posts
					endwhile;
				?>

			</section><!-- #content -->

			<?php 
				// get sidebar
				if ( $layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			?>

		<?php else : ?>

			<?php

				// start loop posts
				while ( have_posts() ) : the_post();
				
					// output content
					get_template_part( 'template-parts/single/slideshow' );

				// end loop posts
				endwhile;

			?>

		<?php endif; ?>

	</div><!-- .wrapper -->

<?php get_footer();
