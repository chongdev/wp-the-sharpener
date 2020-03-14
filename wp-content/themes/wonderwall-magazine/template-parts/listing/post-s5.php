<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<div <?php post_class( 'post-s5 clearfix ' . $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-s5-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, false, $mobile_thumb_height ); ?></a>
		</div><!-- .post-s5-thumb -->
	<?php endif; ?>

	<div class="post-s5-main">

		<div class="post-s5-meta">
			<?php wonderwall_magazine_post_meta( array( 'author', 'timeago' ) ); ?>
		</div><!-- .posts-s5-meta -->

		<h2 class="post-s5-title entry-title" data-ddst-selector=".post-s5-title" data-ddst-label="Post S5 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-s5-excerpt" data-ddst-selector=".post-s5-excerpt" data-ddst-label="Post S5 - Excerpt" data-ddst-no-support="background,border">
			<?php the_excerpt(); ?>
		</div><!-- .post-s5-excerpt -->

	</div><!-- .post-s5-main -->

</div><!-- .post-s5 -->