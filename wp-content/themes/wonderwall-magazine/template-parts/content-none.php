<?php if ( is_search() ) : ?>

	<h2><?php esc_html_e( 'Sorry, but nothing matched your search criteria.', 'wonderwall-magazine' ); ?></h2>
	
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button-back-to-homepage"><span class="fa fa-arrow-left"></span><?php esc_html_e( 'Back to homepage', 'wonderwall-magazine' ); ?></a>
			
	<div class="in-content-search-form">
		<?php get_search_form(); ?>
	</div><!-- .in-content-search-form -->

<?php else : ?>

	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wonderwall-magazine' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>