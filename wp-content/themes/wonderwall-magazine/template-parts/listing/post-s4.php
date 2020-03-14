<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<?php 
	if ( ! isset( $mobile_thumb_width ) ) {
		$mobile_thumb_width = false;
	}
?>
<div <?php post_class( 'post-s4 clearfix ' . $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s4-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, $mobile_thumb_width, $mobile_thumb_height, true ); ?></a>
			<div class="post-s4-thumb-overlay"></div>
			<div class="post-s4-thumb-overlay-2"></div>
		</div><!-- .post-s4-thumb -->
	<?php endif; ?>

	<div class="post-s4-main">

		<div class="post-s4-main-inner">

			<div class="post-s4-cats">
				<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
			</div><!-- .posts-s4-cats -->

			<h2 class="post-s4-title entry-title" data-ddst-selector=".post-s4-title" data-ddst-label="Post S4 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="post-s4-date">
				<?php wonderwall_magazine_post_meta( array( 'date' ) ); ?>
			</div><!-- .post-s4-date -->

		</div><!-- .post-s4-main-inner -->

	</div><!-- .post-s4-main -->

</div><!-- .post-s4 -->