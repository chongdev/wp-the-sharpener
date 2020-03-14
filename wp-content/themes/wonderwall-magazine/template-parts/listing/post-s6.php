<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<div <?php post_class( 'post-s6 clearfix ' . $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s6-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, false, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s6-thumb -->
	<?php endif; ?>

	<div class="post-s6-main">

		<div class="post-s6-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ) ); ?>
		</div><!-- .post-s6-cats -->

		<h2 class="post-s6-title entry-title" data-ddst-selector=".post-s6-title" data-ddst-label="Post S6 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s6-date">
			<?php wonderwall_magazine_post_meta( array( 'date' ) ); ?>
		</div><!-- .post-s6-date -->

	</div><!-- .post-s6-main -->

</div><!-- .post-s6 -->