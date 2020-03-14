<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<div <?php post_class( 'post-s7 clearfix ' . $post_class ); ?>>

	<div class="post-s7-top">
		
		<div class="post-s7-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
		</div><!-- .posts-s7-cats -->

		<h2 class="post-s7-title entry-title" data-ddst-selector=".post-s7-title" data-ddst-label="Post s7 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s7-meta">
			<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'share' ), 'clean' ); ?>
		</div><!-- .posts-s7-date -->

	</div><!-- .post-s7-top -->

	<?php if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ) && wonderwall_magazine_get_theme_mod( 'featured_video_listing', 'disabled' ) == 'enabled' ) : ?>
		<?php $video = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ); ?>
		<div class="post-s7-thumb post-s7-thumb-video">
			<?php echo wp_oembed_get( $video ); ?>
		</div><!-- .post-s7-thumb -->
	<?php elseif ( has_post_thumbnail() ) : ?>
		<div class="post-s7-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, false, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s7-thumb -->
	<?php endif; ?>

	<div class="post-s7-bottom">

		<div class="post-s7-excerpt" data-ddst-selector=".post-s7-excerpt" data-ddst-label="Post s7 - Excerpt" data-ddst-no-support="background,border">
			<?php the_excerpt(); ?>
		</div><!-- .post-s7-excerpt -->

	</div><!-- .post-s7-bottom -->

</div><!-- .post-s7 -->