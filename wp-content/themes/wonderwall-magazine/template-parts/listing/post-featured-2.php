<?php 
$post_data = wonderwall_magazine_get_post_data(); 
extract( $post_data );
?>
<div <?php post_class( 'post-featured-2 clearfix ' . $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-featured-2-thumb">
			<a href="<?php the_permalink(); ?>"><?php wonderwall_magazine_the_post_thumbnail( $thumb_width, $thumb_height, true, false, $mobile_thumb_height, true ); ?></a>
			<div class="post-featured-2-thumb-overlay"></div>
			<div class="post-featured-2-thumb-overlay-2"></div>
		</div><!-- .post-featured-2-thumb -->
	<?php endif; ?>

	<div class="post-featured-2-main">

		<div class="post-featured-2-main-inner">

			<h2 class="post-featured-2-title entry-title" data-ddst-selector=".post-featured-2-title" data-ddst-label="Post Featured 4 - Title" data-ddst-no-support="background,border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="post-featured-2-meta">

				<div class="post-featured-2-cats">
					<?php wonderwall_magazine_post_meta( array( 'category' ), 'clean' ); ?>
				</div><!-- .posts-s4-cats -->

				<div class="post-featured-2-date">
					<?php wonderwall_magazine_post_meta( array( 'author', 'timeago' ) ); ?>
				</div><!-- .post-featured-2-date -->

			</div><!-- .post-featured-2-meta -->

		</div><!-- .post-featured-2-main-inner -->

	</div><!-- .post-featured-2-main -->

</div><!-- .post-featured-2 -->