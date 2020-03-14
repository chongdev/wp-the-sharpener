<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<?php
/**
 * $post_class, $thumb_width and $thumb_height need to be defined in the file that is calling this template part
 */
?>
<div <?php post_class( 'post-s1 clearfix ' . $post_class ); ?>>

	<?php if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ) && wonderwall_magazine_get_theme_mod( 'featured_video_listing', 'disabled' ) == 'enabled' ) : ?>
		<?php $video = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ); ?>
		<div class="post-s1-thumb">
			<?php echo wp_oembed_get( $video ); ?>
		</div><!-- .post-s1-thumb -->
	<?php elseif ( has_post_thumbnail() ) : ?>
		<div class="post-s1-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, 480, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s1-thumb -->
	<?php endif; ?>

	<div class="post-s1-main">

		<div class="post-s1-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
		</div><!-- .posts-s1-cats -->

		<h2 class="post-s1-title entry-title" data-ddst-selector=".post-s1-title" data-ddst-label="Post S1 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s1-meta">
			<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'share', 'views' ), 'clean' ); ?>
		</div><!-- .posts-s1-date -->

		<div class="post-s1-excerpt" data-ddst-selector=".post-s1-excerpt" data-ddst-label="Post S1 - Excerpt" data-ddst-no-support="background,border">
			<?php the_excerpt(); ?>
		</div><!-- .post-s1-excerpt -->

	</div><!-- .post-s1-main -->

</div><!-- .post-s1 -->