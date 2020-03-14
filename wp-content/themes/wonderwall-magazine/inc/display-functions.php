<?php
/**
 * Table of Contents
 *
 * wonderwall_magazine_posts_pagination ( Outputs post pagination )
 * wonderwall_magazine_posts_alternate ( Output posts alternate listing )
 * wonderwall_magazine_display_comments ( Template for comments and pingbacks )
 * wonderwall_magazine_mobile_nav ( Handles output of mobile nav )
 * wonderwall_magazine_section_title ( Displays section title )
 * wonderwall_magazine_admin_logo ( Changed the logo on admin sign in / sign up page )
 * wonderwall_magazine_social_share_links ( output social sharing links )
 * wonderwall_magazine_post_meta ( post meta )
 */

if ( ! function_exists( 'wonderwall_magazine_posts_pagination' ) ) : 

	/**
	 * Output post pagination
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_posts_pagination( $atts = false ) {

		// The output will be stored here
		$output = '';

		if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }
		if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} elseif ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else {
			$paged = 1;
		}

		if ( ! isset( $atts['force_number'] ) ) $force_number = false; else $force_number = $atts['force_number'];
		if ( ! isset( $atts['pages'] ) ) $pages = false; else $pages = $atts['pages'];
		if ( ! isset( $atts['type'] ) ) $type = 'loadmore'; else $type = $atts['type'];
		$range = 2;

		$showitems = ($range * 2)+1;  

		if ( empty ( $paged ) ) { $paged = 1; }

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}

		if( 1 != $pages ) {

			?>
			<div class="pagination pagination-type-<?php echo esc_attr( $type ); ?>">

				<?php if ( $type == 'classic' ) : ?>

					<div class="pagination-classic-numbers">
						<?php for ($i=1; $i <= $pages; $i++) : ?>
							<?php if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) : ?>
								<a href="<?php echo get_pagenum_link($i); ?>" class="<?php if ( $i == $paged ) echo 'active'; ?>"><?php echo esc_html( $i ); ?></a>
							<?php endif; ?>
						<?php endfor; ?>
					</div><!-- .pagination-classic-numbers -->

					<div class="pagination-classic-prev">
						<?php if ( $paged > 1 ) : ?>
							<a href="<?php echo get_pagenum_link($paged - 1); ?>"><span class="fa fa-arrow-left"></span><?php esc_html_e( 'Newer', 'wonderwall-magazine' ); ?></a>
						<?php endif; ?>
					</div><!-- .pagination-classic-prev -->

					<div class="pagination-classic-next">
						<?php if ( $paged < $pages ) : ?>
							<a href="<?php echo get_pagenum_link($paged + 1); ?>"><?php esc_html_e( 'Older', 'wonderwall-magazine' ); ?><span class="fa fa-arrow-right"></span></a>
						<?php endif; ?>
					</div><!-- .pagination-classic-next -->

				<?php else : ?>

					<ul class="clearfix">
						<?php
							
							if ( $type == 'numbered' ) {

								if($paged > 2 && $paged > $range+1 && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link(1)."'>&laquo;</a></li>"; }
								if($paged > 1 && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link($paged - 1)."' >&lsaquo;</a></li>"; }

								for ($i=1; $i <= $pages; $i++){
									if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
										echo ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."'>".$i."</a></li>";
									}
								}

								if ($paged < $pages && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>"; } 
								if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { echo "<li class='inactive'><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>"; }

							// previous and next pagination
							} elseif ( $type == 'prevnext' ) {

								if($paged > 1 ) { echo "<li class='inactive fl'><a href='".get_pagenum_link($paged - 1)."' >" . esc_html__( 'Newer', 'wonderwall-magazine' ) . "</a></li>"; }
								if ($paged < $pages ) { echo "<li class='inactive fr'><a href='".get_pagenum_link($paged + 1)."'>" . esc_html__( 'Older', 'wonderwall-magazine' ) . "</a></li>"; } 

							// WP default
							} elseif ( $type == 'default' ) {

								posts_nav_link();

							}

							// ajax pagination
							if ( $type == 'loadmore' ) {
								if ($paged < $pages ) { 
									echo "<li class='pagination-load-more active'><a href='".get_pagenum_link($paged + 1)."'><span class='fa fa-refresh'></span>" . esc_html__( 'LOAD MORE ARTICLES', 'wonderwall-magazine' ) . "</a></li>";
								} else {
									echo "<li class='pagination-load-more inactive'><a href='#'>" . esc_html__( 'NO MORE ARTICLES', 'wonderwall-magazine' ) . "</a></li>";
								}
							}
							
						?>
					</ul>

				<?php endif; ?>

				<?php if ( $type == 'loadmore' ) : ?>
					<div class="load-more-temp"></div>
				<?php endif; ?>

			</div><!-- .pagination --><?php
		}

	}

endif;  // End if mdrt_posts_slider exists

if ( ! function_exists( 'wonderwall_magazine_posts_alternate' ) ) : 

	/**
	 * Output Posts ( alternate styling )
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_posts_alternate( $args ) {

		// The output will be stored here
		$output = '';

		// Default query arguments
		$def_query_args = array(
			'post_type' => 'post',
			'posts_per_page' => 4,
		);

		// Merge query args
		if ( isset( $args['query_args'] ) && is_array( $args['query_args'] ) ) {
			$query_args = array_merge( $def_query_args, $args['query_args'] );
		} else {
			$query_args = $def_query_args;
		}	

		// Do the query
		$wonderwall_magazine_query = new WP_Query( $query_args );

		// Class attribute
		$post_class = 'blog-post-alt carousel-item ';
		$post_class .= ' ';

		// Class append
		$post_class_append = '';

		// Count
		$count = 0;
		$real_count = 0;

		/**
		 * What to show
		 */

		// Defaults
		$show_heading = false;
		$show_date = false;
		$show_title = false;
		$show_comments = false;

		// Show heading?
		if ( $args['location'] == 'header_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'featured_post_heading_state', 'enabled' ) == 'enabled' ) { $show_heading = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'popular_post_heading_state', 'enabled' ) == 'enabled' ) { $show_heading = true; }
		}

		// Show date?
		if ( $args['location'] == 'header_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'featured_post_date_state', 'enabled' ) == 'enabled' ) { $show_date = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'popular_post_date_state', 'enabled' ) == 'enabled' ) { $show_date = true; }
		}

		// Show title?
		if ( $args['location'] == 'header_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'featured_post_title_state', 'enabled' ) == 'enabled' ) { $show_title = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'popular_post_title_state', 'enabled' ) == 'enabled' ) { $show_title = true; }
		}

		// Show comments?
		if ( $args['location'] == 'header_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'featured_post_comments_state', 'enabled' ) == 'enabled' ) { $show_comments = true; }
		} elseif( $args['location'] == 'footer_posts' ) {
			if ( wonderwall_magazine_get_theme_mod( 'popular_post_comments_state', 'enabled' ) == 'enabled' ) { $show_comments = true; }
		}
		

		?>

		<?php if ( $wonderwall_magazine_query->have_posts() ) : ?>

			<?php if ( isset( $args['heading_title'] ) && $show_heading ) : ?>
				<div class="wrapper">
					<div class="section-heading">
						<h2><?php echo esc_html( $args['heading_title'] ); ?></h2>
						<span class="section-heading-line"></span>
					</div><!-- .section-heading -->
				</div><!-- .wrapper -->
			<?php endif; ?>

			<div class="carousel-container blog-posts-alt clearfix">

				<div class="wrapper">

					<div class="carousel">

						<?php while ( $wonderwall_magazine_query->have_posts() ) : $wonderwall_magazine_query->the_post(); $count++; $real_count++; ?>

							<?php

								// Last col in row?
								$post_class_append = '';
								if ( $count == 3 ) {
									$post_class_append = 'col-last ';
									$count = 0;
								}

							?>
						
							<div <?php post_class( $post_class . $post_class_append ); ?>>

								<?php if ( has_post_thumbnail() ) : ?>
									<div class="blog-post-alt-thumb">
											
										<?php
											$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
											$thumb_url = $thumb_url[0];
											$res_img = wonderwall_magazine_aq_resize( $thumb_url, 600, 400, true );
											$img_alt = wonderwall_magazine_get_attachment_alt( get_post_thumbnail_id() );
										?>

										<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $res_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" /></a>

									</div><!-- .blog-post-alt-thumb -->
								<?php endif; ?>

								<div class="blog-post-alt-main">

									<?php if ( $show_date ) : ?>

										<div class="blog-post-alt-meta">
											<?php 
												the_time( get_option( 'date_format' ) );
												echo ' ';
												esc_html_e( 'by', 'wonderwall-magazine'); 
												echo ' ';
												the_author_posts_link(); 
											?>
										</div><!-- .blog-post-alt-meta -->

									<?php endif; ?>

									<?php if ( $show_title ) : ?>

										<div class="blog-post-alt-title">
											<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										</div><!-- .blog-post-alt-title -->

									<?php endif; ?>

									<?php if ( $show_comments && wonderwall_magazine_get_theme_mod( 'comments', 'enabled' ) == 'enabled' ) : ?>

										<div class="blog-post-alt-comments-count">
											<a href="<?php comments_link(); ?>"><span class="fa fa-comments"></span><?php comments_number( esc_html__( 'No comments', 'wonderwall-magazine' ), esc_html__( 'One comment', 'wonderwall-magazine' ), esc_html__( '% comments', 'wonderwall-magazine' ) ); ?></a>
										</div><!-- .blog-post-alt-comments-count -->

									<?php endif; ?>

								</div><!-- .blog-post-alt-main -->

							</div><!-- .blog-post-alt -->

						<?php endwhile; ?>

					</div><!-- .carousel -->

					<div class="carousel-go-prev"></div>
					<div class="carousel-go-next"></div>

				</div><!-- .wrapper -->

			</div><!-- .blog-posts-listing-alt -->

		<?php else :  ?>

			<?php // Nadda ?>

		<?php endif; ?>

		<?php

		wp_reset_postdata();

	}

endif; // End if wonderwall_magazine_posts_alternate exists

if ( ! function_exists( 'wonderwall_magazine_comment_layout' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_comment_layout( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="comments-pingback">
					<p><?php esc_html_e( 'Pingback:', 'wonderwall-magazine' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'wonderwall-magazine' ), ' ' ); ?></p>
				<?php
			break;
			default :

					?>

					<li <?php comment_class( 'comment' ); ?> id="comment-<?php comment_ID(); ?>">

						<div class="comment-inner">

							<div class="comment-author-avatar"><?php echo get_avatar( $comment, 60 ); ?></div>

							<div class="comment-main clearfix">
								
								<div class="comment-main-top clearfix">

									<div class="comment-meta">
										<div class="comment-meta-author"><?php echo get_comment_author_link(); ?></div>
										<div class="comment-meta-date"><?php echo get_comment_date(); ?></div>
									</div><!-- .comment-main-meta -->

									<div class="comment-reply">
										<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
									</div>

								</div><!-- .comment-main-top -->

								<div class="comment-main-content">
									<?php if ( $comment->comment_approved == '0' ) : ?>
										<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'wonderwall-magazine' ); ?></em></p>
									<?php endif; ?>
									<?php comment_text(); ?>
								</div><!-- .comment-main-content -->

							</div><!-- .comment-main -->

						</div><!-- .comment-inner -->

					<?php

				break;
		endswitch;

	}

endif; // End if wonderwall_magazine_comment_layout

if ( ! function_exists( 'wonderwall_magazine_mobile_nav' ) ) :

	/**
	 * Handles output of mobile nav
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_mobile_nav() {

		$mobile_nav_output = '';
		if ( has_nav_menu('primary') || has_nav_menu( 'top-bar' ) ) {
			
			if ( has_nav_menu( 'top-bar' ) ) $menu_id = 'top-bar';
			if ( has_nav_menu( 'primary' ) ) $menu_id = 'primary';

			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object($locations[$menu_id]);
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$mobile_nav_output = '';
			
			?>

			<select>
				<option><?php esc_html_e( '- Select Page -', 'wonderwall-magazine' ); ?></option>
				<?php foreach ( $menu_items as $key => $menu_item ) : ?>
					<?php
						$title = $menu_item->title;
						$url = $menu_item->url;
						$nav_selected = '';
						//if($menu_item->object_id == get_the_ID()){ $nav_selected = 'selected="selected"'; }
					?>
					<?php if($menu_item->post_parent !== 0) : ?>
						<option value="<?php echo esc_url( $url ); ?>"> - <?php echo esc_html( $title ); ?></option>
					<?php else : ?>
						<option value="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
			<?php

		}

	}

endif; // End if wonderwall_magazine_mobile_nav

function wonderwall_magazine_section_title( $title = false, $prepend = false, $url = false ) {

	if ( $title != '' ) {

		if ( $url ) : 
			?><h2 class="section-title" data-ddst-selector=".section-title a" data-ddst-label="Section Title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a><span class="section-title-linked-line"></span></h2><?php
		else : 
			?><h2 class="section-title" data-ddst-selector=".section-title span" data-ddst-label="Section Title"><span class="section-title-text"><?php if ( $prepend ) : ?><small class="no-caps"><?php echo esc_html( $prepend ); ?></small> <?php endif; ?><?php echo esc_html( $title ); ?></span><span class="section-title-line"></span></h2><?php
		endif;

	}

}

if ( ! function_exists( 'wonderwall_magazine_social_share_links' ) ) : 

	/**
	 * output social sharing links
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_social_share_links( $post_id ) {
		
		// vars
		$post_permalink = get_permalink( $post_id );
		$post_title = str_replace( '&#038;', '', get_the_title( $post_id ) );
		$post_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
		$twitter_share_append = '';
		if ( $twitter_username = wonderwall_magazine_get_theme_mod( 'social_twitter_username' ) ) {
			$twitter_share_append = ' by @' . $twitter_username;
		}

		?>

		<div class="social-widget">
			<span class="social-widget-link">
				<span class="social-widget-link-outline"></span>
				<a class="social-link-facebook" href="#" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'http://www.facebook.com/share.php?u=<?php echo esc_html( $post_permalink ); ?>')"><span class="fa fa-facebook"></span></a>
			</span><!-- .social-widget-link -->
			<span class="social-widget-link">
				<span class="social-widget-link-outline"></span>
				<a class="social-link-pinterest" href="#" target="_blank"  onClick="return wonderwall_magazine_social_share(400, 300, 'https://pinterest.com/pin/create/button/?url=<?php echo esc_html( $post_permalink ); ?>&amp;media=<?php echo esc_html( $post_img ); ?>')"><span class="fa fa-pinterest"></span></a>
			</span><!-- .social-widget-link -->
			<span class="social-widget-link">
				<span class="social-widget-link-outline"></span>
				<a class="social-link-twitter" href="#" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'https://twitter.com/home?status=<?php echo esc_html( $post_title . ' ' . $post_permalink . $twitter_share_append ); ?>')"><span class="fa fa-twitter"></span></a>
			</span><!-- .social-widget-link -->
			<span class="social-widget-link">
				<span class="social-widget-link-outline"></span>
				<a class="social-link-google-plus" href="#" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'https://plus.google.com/share?url=<?php echo esc_html( $post_permalink ); ?>')"><span class="fa fa-google-plus"></span></a>
			</span><!-- .social-widget-link -->
			<span class="social-widget-link">
				<span class="social-widget-link-outline"></span>
				<a class="social-link-email" href="mailto:someone@example.com?subject=<?php echo rawurlencode( $post_title ); ?>&amp;body=<?php echo rawurlencode( $post_title . ' ' . $post_permalink ); ?>"><span class="fa fa-envelope-o"></span></a>
			</span><!-- .social-widget-link -->
		</div><!-- .social-widget -->

		<?php

	}

endif; // end if statement for function exists

if ( ! function_exists( 'wonderwall_magazine_post_meta' ) ) {

	/**
	 * Meta information for posts listing
	 *
	 * @since 1.0
	 */
	function wonderwall_magazine_post_meta( $elements = array(), $sep_style = 'dot' ) {

		global $post;				
		$user_data = get_userdata( $post->post_author );		

		// Show separator
		$sep = false;

		?>
		<div class="post-meta">
			
			<?php if ( in_array( 'category', $elements ) ) : ?>
				<span class="post-meta-cats" data-ddst-selector=".post-meta-cats a" data-ddst-label="Post Meta - Category" data-ddst-no-support="background,border"><?php the_category( ' ', '', get_the_ID() ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'date', $elements ) ) : ?>
				<?php 
					if ( $sep ) {
						if ( $sep_style == 'dot' ) {
							echo '<span class="post-meta-separator"></span>';
						} else {
							echo '<span class="post-meta-separator-clean"></span>';
						}
					}
				?>
				<?php
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
				}

				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);
				?>
				<span class="post-meta-date" data-ddst-selector=".post-meta-date" data-ddst-label="Post Meta - Date" data-ddst-no-support="background,border">
					<span class="post-meta-date-date"><?php echo $time_string; ?></span> 
					<?php if ( $user_data instanceof WP_User ) : ?><span class="post-meta-date-author"><?php esc_html_e( 'by', 'wonderwall-magazine'); ?> <span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( $post->post_author, $user_data->user_nicename ); ?>"><?php echo esc_html( $user_data->display_name ); ?></a></span></span><?php endif; ?>
				</span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'comments', $elements ) && wonderwall_magazine_get_theme_mod( 'comments', 'enabled' ) == 'enabled' ) : ?>
				<?php 
					if ( $sep ) {
						if ( $sep_style == 'dot' ) {
							echo '<span class="post-meta-separator"></span>';
						} else {
							echo '<span class="post-meta-separator-clean"></span>';
						}
					}
				?>
				<span class="post-meta-comments"><span class="fa fa-comment"></span><a href="<?php comments_link(); ?>"><?php comments_number( esc_html__( 'No Comments', 'wonderwall-magazine' ),esc_html__( 'One Comment', 'wonderwall-magazine' ), esc_html__( '% Comments', 'wonderwall-magazine' ) ) ?></a></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'timeago', $elements ) ) : ?>
				<?php 
					if ( $sep ) {
						if ( $sep_style == 'dot' ) {
							echo '<span class="post-meta-separator"></span>';
						} else {
							echo '<span class="post-meta-separator-clean"></span>';
						}
					}
				?>
				<span class="post-meta-time-ago" data-ddst-selector=".post-meta-time-ago" data-ddst-label="Post Meta - Time Ago" data-ddst-no-support="background,border"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'wonderwall-magazine' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'views', $elements ) && wonderwall_magazine_get_theme_mod( 'view_counts', 'disabled' ) == 'enabled' ) : ?>
				<?php $views_count = 1; ?>
				<?php if ( get_post_meta( get_the_ID(), 'dd_viewed_count', true ) ) { $views_count = get_post_meta( get_the_ID(), 'dd_viewed_count', true ); } ?>
				<?php 
					if ( $sep ) {
						if ( $sep_style == 'dot' ) {
							echo '<span class="post-meta-separator"></span>';
						} else {
							echo '<span class="post-meta-separator-clean"></span>';
						}
					}
				?>
				<span class="post-meta-views-count" data-ddst-selector=".post-meta-views-count" data-ddst-label="Post Meta - Views Count" data-ddst-no-support="background,border"><span class="fa fa-eye"></span><?php echo esc_html( $views_count ); ?> <?php esc_html_e( 'views', 'wonderwall-magazine' ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'shares', $elements ) ) : ?>
				<?php 
					if ( $sep ) {
						if ( $sep_style == 'dot' ) {
							echo '<span class="post-meta-separator"></span>';
						} else {
							echo '<span class="post-meta-separator-clean"></span>';
						}
					}
				?>
				<?php $shares_count = wonderwall_magazine_get_social_count( get_the_ID() ); ?>
				<span class="post-meta-shares-count" data-post-id="<?php echo get_the_ID() ; ?>" data-ddst-selector=".post-meta-shares-count" data-ddst-label="Post Meta - Shares" data-ddst-no-support="background,border"><span class="fa fa-share"></span><?php echo esc_html( $shares_count['total'] ); ?></span>
			<?php $sep = true; endif; ?>

			<?php if ( in_array( 'share', $elements ) ) : ?>
				<?php 
					if ( $sep ) {
						if ( $sep_style == 'dot' ) {
							echo '<span class="post-meta-separator"></span>';
						} else {
							echo '<span class="post-meta-separator-clean"></span>';
						}
					}
				?>
				
				<?php $shares_count = wonderwall_magazine_get_social_count( get_the_ID() ); ?>

				<?php
				// vars
				$post_id = get_the_ID();
				$post_permalink = get_permalink( $post_id );
				$post_title = str_replace( '&#038;', '', get_the_title( $post_id ) );
				$post_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$twitter_share_append = '';
				if ( $twitter_username = wonderwall_magazine_get_theme_mod( 'social_twitter_username' ) ) {
					$twitter_share_append = ' by @' . $twitter_username;
				}
				?>

				<span class="post-meta-share" data-post-id="<?php echo get_the_ID() ; ?>">
					<span class="fa fa-share"></span><?php esc_html_e( 'Share this', 'wonderwall-magazine' ); ?>
					<span class="post-meta-share-popup">
						<span class="post-meta-share-popup-top">
							&nbsp;
						</span><!-- .post-meta-share-popup-top -->
						<span class="post-meta-share-popup-bottom">
							<a href="#" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'http://www.facebook.com/share.php?u=<?php echo esc_html( $post_permalink ); ?>')"><span class="fa fa-facebook"></span></a>
							<a href="#" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'https://twitter.com/home?status=<?php echo esc_html( $post_title . ' ' . $post_permalink . $twitter_share_append ); ?>')"><span class="fa fa-twitter"></span></a>
							<a href="#" target="_blank"  onClick="return wonderwall_magazine_social_share(400, 300, 'https://pinterest.com/pin/create/button/?url=<?php echo esc_html( $post_permalink ); ?>&amp;media=<?php echo esc_html( $post_img ); ?>')"><span class="fa fa-pinterest"></span></a>
							<a href="#" target="_blank" onClick="return wonderwall_magazine_social_share(400, 300, 'https://plus.google.com/share?url=<?php echo esc_html( $post_permalink ); ?>')"><span class="fa fa-google-plus"></span></a>
						</span><!-- .post-meta-share-popup-bottom -->
					</span><!-- .post-meta-share-popup -->
				</span>

			<?php $sep = true; endif; ?>

		</div><!-- .post-meta -->
		<?php

	}

}