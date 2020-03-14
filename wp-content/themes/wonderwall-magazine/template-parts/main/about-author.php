<?php
	
	// get author ID	
	if ( get_the_author_meta( 'ID' ) )
		$author_id = get_the_author_meta( 'ID' );
	else
		$author_id = 1;

?>

<?php if ( get_the_author_meta( 'description', $author_id ) ) : ?>

	<div class="about-author clearfix">
						
		<div class="about-author-sidebar">
			<div class="about-author-avatar">
				<?php echo get_avatar( $author_id , 80 ); ?>
			</div><!-- .about-author-avatar -->
		</div><!-- .about-author-sidebar -->

		<div class="about-author-main">

			<div class="about-author-name"><?php the_author_posts_link(); ?></div>

			<div class="about-author-bio">
				<?php echo get_the_author_meta( 'description', $author_id ); ?>
			</div><!-- .about-author-bio -->

			<div class="about-author-social">
				<?php if ( get_the_author_meta( 'wonderwall_magazine_twitter', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'wonderwall_magazine_twitter' ); ?>"><span class="fa fa-twitter"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'wonderwall_magazine_facebook', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'wonderwall_magazine_facebook' ); ?>"><span class="fa fa-facebook"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'wonderwall_magazine_instagram', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'wonderwall_magazine_instagram' ); ?>"><span class="fa fa-instagram"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'wonderwall_magazine_behance', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'wonderwall_magazine_behance' ); ?>"><span class="fa fa-behance"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'wonderwall_magazine_dribbble', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'wonderwall_magazine_dribbble' ); ?>"><span class="fa fa-dribbble"></span></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'wonderwall_magazine_vine', $author_id ) ) : ?>
					<a href="<?php echo get_the_author_meta( 'wonderwall_magazine_dribbble' ); ?>"><span class="fa fa-vine"></span></a>
				<?php endif; ?>
			</div><!-- .about-author-social -->

		</div><!-- .about-author-main -->

	</div><!-- .about-author -->

<?php endif; ?>