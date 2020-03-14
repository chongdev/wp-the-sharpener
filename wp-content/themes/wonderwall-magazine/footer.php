				<?php

					// if page has sections
					if ( is_singular( 'page' ) && wonderwall_magazine_has_page_sections() ) {

						// get page sections
						$sections = wonderwall_magazine_get_page_sections();

						// loop page sections
						foreach( $sections as $section ) {

							// set section info
							wonderwall_magazine_set_section_info( $section );

							// call the template
							get_template_part( 'template-parts/home/' . $section['section'] );

						}

					}

				?>

			</div><!-- #main -->

			<footer id="footer" class="site-footer">

				<?php get_template_part( 'template-parts/footer/banner' ); ?>

				<?php get_template_part( 'template-parts/footer/subscribe' ); ?>

				<?php get_template_part( 'template-parts/footer/widgets' ); ?>

				<?php get_template_part( 'template-parts/footer/instagram' ); ?>

				<?php get_template_part( 'template-parts/footer/bottom' ); ?>

			</footer><!-- #footer -->

		</div><!-- #page -->

	</div><!-- #container -->

	<?php get_template_part( 'template-parts/side-panel' ); ?>

	<?php get_template_part( 'template-parts/search-overlay' ); ?>

	<?php get_template_part( 'template-parts/fly-in-post-navigation' ); ?>

	<?php get_template_part( 'template-parts/to-top' ); ?>

	<?php wp_footer(); ?>

</body>
</html>
