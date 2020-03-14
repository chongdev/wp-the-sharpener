<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<div <?php post_class( 'post-s2 clearfix ' . $post_class ); ?>>

	<?php if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ) && wonderwall_magazine_get_theme_mod( 'featured_video_listing', 'disabled' ) == 'enabled' ) : ?>
		<?php $video = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ); ?>
		<div class="post-s2-thumb">
			<?php echo wp_oembed_get( $video ); ?>
		</div><!-- .post-s2-thumb -->
	<?php elseif ( has_post_thumbnail() ) : ?>
		<div class="post-s2-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, 480, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s2-thumb -->
	<?php endif; ?>

	<div class="post-s2-main">

		<div class="post-s2-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
		</div><!-- .posts-s2-cats -->
		
		<h2 class="post-s2-title entry-title" data-ddst-selector=".post-s2-title" data-ddst-label="Post S2 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s2-excerpt" data-ddst-selector=".post-s2-excerpt" data-ddst-label="Post S2 - Excerpt" data-ddst-no-support="background,border">
			<?php the_excerpt(); ?>
		</div><!-- .posts-2-excerpt -->

		<div class="post-s2-date">
			<?php wonderwall_magazine_post_meta( array( 'date' ) ); ?>
		</div><!-- .post-s2-date -->

	</div><!-- .post-s2-main -->

</div><!-- .post-s2 -->