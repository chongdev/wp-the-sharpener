<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<div <?php post_class( 'post-s3 clearfix ' . $post_class ); ?>>

	<?php if ( wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ) && wonderwall_magazine_get_theme_mod( 'featured_video_listing', 'disabled' ) == 'enabled' ) : ?>
		<?php $video = wonderwall_magazine_get_post_meta( get_the_ID(), 'featured_video' ); ?>
		<div class="post-s3-thumb post-s3-thumb-video">
			<?php echo wp_oembed_get( $video ); ?>
		</div><!-- .post-s3-thumb -->
	<?php elseif ( has_post_thumbnail() ) : ?>
		<div class="post-s3-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, false, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s3-thumb -->
	<?php endif; ?>

	<div class="post-s3-main">

		<div class="post-s3-cats">
			<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
		</div><!-- .posts-s3-cats -->

		<h2 class="post-s3-title entry-title" data-ddst-selector=".post-s3-title" data-ddst-label="Post S3 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s3-meta">
			<?php wonderwall_magazine_post_meta( array( 'date', 'comments', 'share', 'views' ), 'clean' ); ?>
		</div><!-- .posts-s3-meta -->

		<div class="post-s3-excerpt" data-ddst-selector=".post-s3-excerpt" data-ddst-label="Post S3 - Excerpt" data-ddst-no-support="background,border">
			<?php the_excerpt(); ?>
		</div><!-- .post-s3-excerpt -->

	</div><!-- .post-s3-main -->

</div><!-- .post-s3 -->