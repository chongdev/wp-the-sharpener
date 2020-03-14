<?php get_header(); ?>
	
	<div class="wrapper clearfix">
	
		<section id="content" class="col col-8">

			<h2><?php esc_html_e( 'We can\'t seem to find the page you\'re looking for.', 'wonderwall-magazine' ); ?></h2>
		
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button-back-to-homepage"><span class="fa fa-arrow-left"></span><?php esc_html_e( 'Back to homepage', 'wonderwall-magazine' ); ?></a>
			
			<div class="in-content-search-form">
				<?php get_search_form(); ?>
			</div><!-- .in-content-search-form -->

		</section><!-- #content -->

		<?php get_sidebar(); ?>

	</div><!-- .wrapper -->

<?php get_footer();
