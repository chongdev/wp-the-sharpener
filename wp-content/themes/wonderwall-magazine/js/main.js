"use strict";

/**
 * = Table Of Contents =
 * 
 * wonderwall_magazine_masonry ( initiate masonry )
 * wonderwall_magazine_social_share ( social sharing ) 
 * wonderwall_magazine_carousel ( carousel )
 * wonderwall_magazine_retina_img_replace ( retina images replace )
 * wonderwall_magazine_mobile_images ( replace smaller images with bigger versions ) 
 * wonderwall_magazine_featured_navigation( featured navigation )
 * wonderwall_magazine_tabs ( tabs functionality )
 *
 * # ready
 * # load
 * # scroll
 * # resize
*/

/**
 * initiate masonry
 */
function wonderwall_magazine_masonry() {

	var gutter = parseInt( jQuery('.wrapper').width() / 100 * 2.76 );

	jQuery('.masonry-init').masonry({
		itemSelector: '.masonry-item',
		columnWidth: '.grid-sizer',
		gutter: '.gutter-sizer',
		percentPosition: true,
	});

	jQuery('.blog-post-single-content .gallery').masonry({
		itemSelector: '.gallery-item',
	});

}

/**
 * social sharing
 */
function wonderwall_magazine_social_share( width, height, url ) {

	// vars
	var leftPosition, topPosition, u, t, windowFeatures;

	// positions
	leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
	topPosition = (window.screen.height / 2) - ((height / 2) + 50);
	
	// window features
	windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";

	// other
	u=location.href;
	t=document.title;

	// open up new window
	window.open(url,'sharer', windowFeatures);

	// return
	return false;

}

/**
 * carousel
 */
function wonderwall_magazine_carousel() {

	// each carousel
	jQuery('.carousel').each(function(){

		// vars
		var pagination,
		items,
		tabletItems,
		transitionStyle,
		slideSpeed,
		single = false;

		// show carousel
		jQuery(this).show();

		// pagination
		if ( jQuery(this).data('pagination') == true ) {
			pagination = true;
		} else {
			pagination = false;
		}

		// items
		if ( jQuery(this).data('items') ) {
			items = jQuery(this).data('items');
		} else {
			items = 3;
		}

		// tablet items
		if ( jQuery(this).data('tablet-items') ) {
			tabletItems = jQuery(this).data('tablet-items');
		} else {
			tabletItems = items;
		}

		// single
		if ( items == 1 ) {
			single = true;
		}

		// transitionStyle
		if ( jQuery(this).data('transition-style') ) {
			transitionStyle = jQuery(this).data('transition-style');
		} else {
			transitionStyle = false;
		}

		// slideSpeed
		if ( jQuery(this).data('slide-speed') ) {
			slideSpeed = parseInt( jQuery(this).data('slide-speed') );
		} else {
			slideSpeed = 1000;
		}

		// vars
		var firstItem = jQuery(this).find('.carousel-item:first'),
		slider = jQuery(this),
		spacing;

		if ( jQuery(this).closest('.wrapper') ) {
			spacing = jQuery(this).closest('.wrapper').width() / 100 * 2.76 / 2;
		} else {
			spacing = jQuery('.wrapper').width() / 100 * 2.76 / 2;
		}

		// no spacing
		if ( slider.closest('.no-col-spacing').length ) {
			spacing = 0;
		}

		// custom spacing
		if ( jQuery(this).data('spacing') ) {
			spacing = parseInt( jQuery(this).data('spacing') );
		}

		if ( jQuery(this).closest('.featured-4').length ) {
			var wrapper = jQuery(this).closest('.carousel-wrapper');
		} else {
			if ( jQuery(this).closest('.wrapper') ) {
				var wrapper = jQuery(this).closest('.wrapper');
			} else {
				var wrapper = jQuery('.wrapper');
			}
		}

		// apply sizes
		if ( single == false ) {
			slider.find('.carousel-item').css({ 'padding-left' : spacing, 'padding-right' : spacing });
			slider.css({ 'margin-left' : spacing * -1, 'width' : wrapper.width() + spacing * 2 });
		}

		// duplicate content on left and right
		if ( slider.closest('.featured-3').length || slider.closest('.featured-4').length || slider.closest('.featured-6').length  ) {

			// content
			var duplicateContent = slider.html();

			// duplicate if not iPhone
			if( ! navigator.userAgent.match(/iPhone/i) ) {
				// Duplicate 2x before and after if less than 12
				if ( slider.find('.carousel-item').length < 12 ) {
					slider.prepend( duplicateContent );
					slider.prepend( duplicateContent );
					slider.append( duplicateContent );
					slider.append( duplicateContent );		
				// If more than 12 duplicate once before and after
				} else {
					slider.prepend( duplicateContent );
					slider.append( duplicateContent );
				}
			}

		}

		// set first carousel item class
		firstItem.addClass('first-carousel-item');

		// initiate carousel
		jQuery(this).owlCarousel({
			transitionStyle : transitionStyle,
			slideSpeed : slideSpeed,
			mouseDrag : true,
			pagination : pagination,
			scrollPerPage: true,
			items: items,
			single : single,
			itemsDesktop : [ 1500, items ],
			itemsDesktopSmall : [ 1280, items ],
			itemsTablet : [1024,tabletItems],
			itemsMobile : [767,1],
			afterAction: function( carousel ){
				var visible_items = this.owl.visibleItems;
				carousel.find('.carousel-item-visible').removeClass('carousel-item-visible');
				carousel.find('.owl-item').filter(function(index) {
					return visible_items.indexOf(index) > -1;
				}).addClass('carousel-item-visible');				
			},
		});

		// jump to first
		var owl = slider.data('owlCarousel');
		owl.jumpTo( slider.find('.first-carousel-item').closest('.owl-item').index() );

	});

	jQuery(document).on( 'click', '.carousel-nav-trigger-prev', function(){
		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel');		
		carousel.trigger('owl.prev');
		wonderwall_magazine_featured_navigation();
	});

	jQuery(document).on( 'click', '.carousel-nav-trigger-next', function(){
		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel');		
		carousel.trigger('owl.next');
		wonderwall_magazine_featured_navigation();
	});

	// prev
	jQuery(document).on( 'mousedown', '.carousel-nav-prev, .carousel-nav-circle-prev, .carousel-nav-arrow-prev, .featured-nav-prev', function() {
		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel');		
		carousel.trigger('owl.prev');
		wonderwall_magazine_featured_navigation();
	});

	// next
	jQuery(document).on( 'mousedown', '.carousel-nav-next, .carousel-nav-circle-next, .carousel-nav-arrow-next, .featured-nav-next', function() {
		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel');
		carousel.trigger('owl.next');
		wonderwall_magazine_featured_navigation();
	});

	// Prev ( with animation )
	jQuery(document).on( 'click', '.carousel-nav-trigger-prev-animate', function() {

		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel'),
		owl = carousel.data('owlCarousel'),		
		carouselNext = carousel.find('.carousel-item-visible:first').prev('.owl-item');
			
		if ( carouselNext.length ) {

			// Get vars
			var currentSlideInfo = carousel.find('.carousel-item-visible .post-s4-main'),
			topOffset = currentSlideInfo.position().top + 20;	

			// Hide the text on the next one
			carouselNext.find( '.post-s4-main' ).css({ opacity : 0 });

			// Animate
			currentSlideInfo.stop().animate( { top : topOffset, opacity : 0 }, 600, 'easeInOutCubic', function() {

				// Make it slide
				carousel.data( 'owlCarousel' ).goTo( carouselNext.index() );

				currentSlideInfo.css({ top : topOffset - 20 });

				setTimeout( function(){
					
					var currentSlideInfo = carousel.find('.carousel-item-visible .post-s4-main'),
					topOffset = currentSlideInfo.position().top - 20;

					currentSlideInfo.css({ top : topOffset }).stop().animate({ top : topOffset + 20, opacity : 1 }, 600, 'easeInOutCubic');

				}, 500);

			});

		}

	});

	// Next ( with animation )
	jQuery(document).on( 'click', '.carousel-nav-trigger-next-animate', function() {

		var carousel = jQuery(this).closest('.carousel-wrapper').find('.carousel'),
		owl = carousel.data('owlCarousel'),	
		carouselNext = carousel.find('.carousel-item-visible:first').next('.owl-item');
			
		if ( carouselNext.length ) {

			// Get vars
			var currentSlideInfo = carousel.find('.carousel-item-visible .post-s4-main'),
			topOffset = currentSlideInfo.position().top + 20;	

			// Hide the text on the next one
			carouselNext.find( '.post-s4-main' ).css({ opacity : 0 });

			// Animate
			currentSlideInfo.stop().animate( { top : topOffset, opacity : 0 }, 600, 'easeInOutCubic', function() {

				// Make it slide
				carousel.data( 'owlCarousel' ).goTo( carouselNext.index() );

				currentSlideInfo.css({ top : topOffset - 20 });

				setTimeout( function(){
					
					var currentSlideInfo = carousel.find('.carousel-item-visible .post-s4-main'),
					topOffset = currentSlideInfo.position().top - 20;

					currentSlideInfo.css({ top : topOffset }).stop().animate({ top : topOffset + 20, opacity : 1 }, 600, 'easeInOutCubic');

				}, 500);

			});

		}

	});

	// featured slider navigation
	wonderwall_magazine_featured_navigation();

}

/**
 * post gallery carousel
 */
function wonderwall_magazine_post_gallery_carousel() {

	// each carousel
	jQuery('.gallery-carousel').each(function(){

		jQuery(this).show();

		// initiate carousel
		jQuery(this).owlCarousel({			
			autoHeight : true,
			slideSpeed : 700,
			mouseDrag : true,
			pagination : true,
			scrollPerPage: true,
			items: 1,
			single : true,
			itemsDesktop : [ 1500, 1 ],
			itemsDesktopSmall : [ 1280, 1 ],
			itemsTablet : [1024, 1],
			itemsMobile : [767, 1],
		});

	});

	jQuery(document).on( 'click', '.gallery-carousel-nav-trigger-prev', function(){
		var carousel = jQuery(this).closest('.gallery-carousel-wrapper').find('.gallery-carousel');		
		carousel.trigger('owl.prev');
		wonderwall_magazine_featured_navigation();
	});

	jQuery(document).on( 'click', '.gallery-carousel-nav-trigger-next', function(){
		var carousel = jQuery(this).closest('.gallery-carousel-wrapper').find('.gallery-carousel');		
		carousel.trigger('owl.next');
		wonderwall_magazine_featured_navigation();
	});

}

/**
 * retina images
 */
function wonderwall_magazine_retina_img_replace() {

	// go through each image with retina version
	jQuery('img.has-retina-ver').each(function(){

		// replace src attribute
		jQuery(this)
			.css({ height : jQuery(this).height(), width : jQuery(this).width() })
			.attr( 'src', jQuery(this).data('retina-ver') );		

	});

}

/**
 * replace smaller images with bigger versions
 */
function wonderwall_magazine_mobile_images() {

	// mobile
	if ( jQuery(window).width() <= 767 ) {

		// vars
		var images = jQuery('img[data-mobile-version]'),
		mobileVersion = '';

		// go through each image with mobile version
		images.each(function(){

			// get src
			mobileVersion = jQuery(this).data('mobile-version');

			// apply src
			if ( mobileVersion !== '' ) {
				jQuery(this).attr( 'src', mobileVersion );
			}

		});

	}

	// tablet
	if ( jQuery(window).width() <= 1023 && jQuery(window).width() > 767 ) {

		// vars
		var images = jQuery('img[data-tablet-version]'),
		tabletVersion = '';

		// go through each image with tablet version
		images.each(function(){

			// get src
			tabletVersion = jQuery(this).data('tablet-version');

			// apply src
			if ( tabletVersion !== '' ) {
				jQuery(this).attr( 'src', tabletVersion );
			}

		});

	}

}

/**
 * featured navigation
 */
function wonderwall_magazine_featured_navigation(){

	// if there is a featured section
	if ( jQuery('.featured').length ) {

		var featured = jQuery('.featured');

		// nav
		var featuredNavPrev = featured.find('.featured-nav-prev'),
		featuredNavNext = featured.find('.featured-nav-next'),
		featuredNavPrevImg = featuredNavPrev.find('.featured-nav-image'),
		featuredNavNextImg = featuredNavNext.find('.featured-nav-image');
			
		// current
		var featuredCurrent = featured.find('.carousel-item-visible');

		// prev
		if ( featuredCurrent.prev('.owl-item').length ) {
			var featuredPrev = featuredCurrent.prev('.owl-item');
		} else {
			var featuredPrev = featuredCurrent.siblings('.owl-item:last-child');
		}

		// next
		if ( featuredCurrent.next('.owl-item').length ) {
			var featuredNext = featuredCurrent.next('.owl-item');
		} else {
			var featuredNext = featuredCurrent.siblings('.owl-item:first-child');
		}

		// get images
		var featuredPrevImage = featuredPrev.find('.featured-item-right img').attr('src');
		var featuredNextImage = featuredNext.find('.featured-item-right img').attr('src');

		// apply images
		featuredNavPrevImg.css({ 'background-image' : 'url(' + featuredPrevImage + ')' });
		featuredNavNextImg.css({ 'background-image' : 'url(' + featuredNextImage + ')' });

	}

}

/**
 * tabs functionality
 */
function wonderwall_magazine_tabs() {

	jQuery(document).on( 'click', '.mega-menu-tabs-nav-item', function(){

		var navItem = jQuery(this),
		index = navItem.index(),
		tabs = navItem.closest('.mega-menu-tabs'),
		tabsContentItems = tabs.find('.mega-menu-tabs-content-item');

		// add active class to nav item
		navItem.addClass('active').siblings('.active').removeClass('active');

		// add active class to content
		tabsContentItems.eq(index).addClass('active').siblings('.active').removeClass('active');

	});

	// activate the first ones
	jQuery('.mega-menu-tabs').each(function(){
		jQuery(this).find('.mega-menu-tabs-nav-item:first-child').trigger('click');
	});

}

/**
 * navigation active line
 */
function wonderwall_magazine_nav_active_line() {

	// vars
	var navigation = jQuery('#navigation-inner'),
	active = jQuery('#navigation .menu > li.current-menu-item > a, #navigation .menu > li.current-menu-ancestor > a');
	if ( jQuery('#navigation .menu > li.current-menu-item-hover').length ) {
		active = jQuery('#navigation .menu > li.current-menu-item-hover');	
	}

	// if there is an active menu item
	if ( active.length ) {

		var activeWidth = active.width(),
		activeOffset = active.offset().left - navigation.offset().left,
		navLine = jQuery('.navigation-active-line');

		// change width
		navLine.css({ width : activeWidth, left : activeOffset });

	}

}

/**
 * featured 7 center
 */
function wonderwall_magazine_featured_7_center() {

	// if there is featured 7
	if ( jQuery('.featured-7').length ) {

		var parentHeight = jQuery('.featured-7-primary').height(),
		childHeight = jQuery('.featured-7-primary-main').outerHeight(),
		offset = parentHeight / 2 - childHeight / 2;

		if ( offset > 1 ) {
			jQuery('.featured-7-primary-main').css({ marginTop : offset, opacity : 1 });
		} else {
			jQuery('.featured-7-primary-main').css({ opacity : 1 });
		}

	}

}

/** 
 * search overlay center
 */
function wonderwall_magazine_search_overlay_center() {

	if ( jQuery('.search-overlay').length ) {

		var searchOverlay = jQuery('.search-overlay'),
		searchOverlayMain = jQuery('.search-overlay-main'),
		offset = searchOverlay.height() / 2 - searchOverlayMain.height() / 2;

		if ( offset > 1 ) {
			searchOverlayMain.css({ marginTop : offset });
		}

	}

}

/**
 * post header 3 center
 */
function wonderwall_magazine_post_header_3_center() {

	// if there is featured 7
	if ( jQuery('.blog-post-single-header-3').length ) {

		var parentHeight = jQuery('.blog-post-single-header-3').height(),
		childHeight = jQuery('.blog-post-single-header-main').outerHeight(),
		offset = parentHeight / 2 - childHeight / 2;

		if ( offset > 1 ) {
			jQuery('.blog-post-single-header-main').css({ marginTop : offset, opacity : 1 });
		}

	}

}

/**
 * adjacent post none height
 */
function wonderwall_magazine_adjacent_post_none_height() {
	if ( jQuery('.adjacent-post-none').length ) {
		jQuery('.adjacent-post-none-text').css({ lineHeight : jQuery('.adjacent-posts').height() + 'px' });
	}
}

/**
 * # ready
 */
jQuery(document).ready(function($){

	// fit videos
	$('body').fitVids();

	// apply mobile images
	wonderwall_magazine_mobile_images();

	// tabs
	wonderwall_magazine_tabs();

	// remove empty paragraphs
	jQuery('p:empty').remove();

	// go to top
	$('#go-to-top').on( 'click', function(){
		$('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
	});

	// sticky top bar
	$('.body-top-bar-sticky-enabled #top-bar').sticky();

	// add the line to post meta cats
	$('.post-meta-cats a').each(function(){
		$(this).html( '<span class="post-meta-cats-text">' + $(this).html() + '</span>' ).prepend('<span class="post-meta-cats-line"></span>');
	});

	// add # to tags
	$('.blog-post-single-tags a').each(function(){
		$(this).prepend('#');
	});

	// add arrows to navigation items with submenus
	$('#navigation #primary-menu > li:has(ul) > a').append('<span class="fa fa-chevron-down"></span>');
	$('#navigation #primary-menu > li:has(ul.sub-menu-mega-menu)').addClass('has-mega-menu');
	$('#top-bar-navigation #top-bar-menu > li:has(ul) > a').append('<span class="fa fa-chevron-down"></span>');
	
	// mobile navigation
	$('#mobile-navigation select').change(function() { window.location = $(this).val(); });	

	// navigation panel hook
	 $(document).on( 'click', '#navigation-panel-hook, #panel-close, #panel-overlay', function(){
	 	$('body').toggleClass('panel-active');
	 });

	// search overlay open
	$(document).on( 'click', '.search-overlay-open', function(){
		$('.search-overlay').fadeIn(200, function(){
			$(this).addClass('active');
			wonderwall_magazine_search_overlay_center();
		});
		$('.search-overlay input').focus();
	});

	// search overlay close
	$(document).on( 'click', '.search-overlay-close', function(){
		$('.search-overlay').fadeOut(200, function(){
			$(this).removeClass('active');
		});
	});

	// header search
	 $(document).on( 'click', '#header-search-button', function(e){
	 		
	 	// if already open close it
	 	if ( $(this).hasClass('active') ) {

	 		// clicked element
	 		var target = $( e.target );

	 		// if not the close icon
	 		if( ! target.is('.header-search-button-icon') ) return;

	 		// remove active class
		 	$(this).removeClass('active');

		 	// animate width
		 	$(this).find('input').animate({ opacity : 0 }, 200, function(){
		 		$(this).closest('#header-search-button').animate({ 'width' : '41px' }, 200 );
		 	});

		// otherwise open 
		} else {

			$(this).find('input').focus();

		 	// add active class
		 	$(this).addClass('active');

		 	// animate width
			$(this).animate({ 'width' : '200px' }, 200, function(){
				$(this).find('input').animate({ opacity : 1 }, 200);
			});

		}

	 });

	$(document).on( 'click', '.pagination-load-more a', function(e) {

		if ( $('body').hasClass('ddst-active') )
			return false;

		e.preventDefault();

		if ( $(this).parent().hasClass('active') ) {

			var _this = $(this);

			if ( $(this).closest('.blog-posts-listing').length ) {
				var module = $(this).closest('.blog-posts-listing');
				var postsContainer = module.find('.blog-posts-listing-inner');
				var target = ' .blog-posts-listing';
				var targetInner = '.blog-posts-listing-inner'
			} else if ( $(this).closest('.module-posts-listing').length ) {
				var module = $(this).closest('.module-posts-listing');
				var moduleID = module.data('id');
				var postsContainer = module.find('.module-posts-listing-inner');
				var target = ' .module-posts-listing.' + moduleID;
				var targetInner = '.module-posts-listing-inner'
			}

			var pagination = module.find('.pagination'),
			moduleID = module.attr('id'),
			pagLink = _this.attr('href'),
			tempHolder = module.find('.load-more-temp');

			_this.find('.fa').addClass('fa-spin');

			tempHolder.load( pagLink + target, function(){

				if ( postsContainer.hasClass('masonry-init') ) { 

					// get new content
					var content = jQuery( tempHolder.find('.module-posts-listing-inner .post-s4, .module-posts-listing-inner .post-s1') );

					// add new content
					postsContainer.append( content );

					// wait for all images to load
					postsContainer.waitForImages(function() {

						// reorder
						postsContainer.masonry( 'appended', content );

						// change pagination HTML
						module.find('.pagination').html( tempHolder.find('.pagination').html() );

						// replace pagination HTML
						pagination.replaceWith( tempHolder.find('.pagination') );

						// remove temporary holder HTML
						tempHolder.html('');

					});

				} else {
					postsContainer.append( tempHolder.find(targetInner).html() );
					module.find('.pagination').html( tempHolder.find('.pagination').html() );
					pagination.replaceWith( tempHolder.find('.pagination') );
					tempHolder.html('');
					jQuery(window).resize();
				}

			});
		}	

	});

	// popup gallery
	$('.hidden-lightbox-gallery').magnificPopup({
		delegate: 'a',
		gallery: {
			enabled: true
		},
		type: 'image'
	});

	// wrap images in anchor ( for lightbox )
	$('.blog-post-single-content img').each(function(){
		
		var srcset = $(this).attr('srcset'),
		size,
		sizeSrc,
		currHighest = 0;

		if ( srcset ) {			

			// turn into array
			srcset = srcset.split( ',' );

			// go through each
			jQuery.each( srcset, function(index, value) {

				// split src and width into array
				value = jQuery.trim(value);
				value = value.split( ' ' );
				
				// turn width into integer
				value[1] = parseInt( value[1] );

				// if bigger than the previous
				if ( currHighest < value[1] ) {
					currHighest = value[1];
					sizeSrc = value[0];
				}

			});
			
			$(this).wrap( '<a class="open-in-lightbox" href="' + sizeSrc + '"></a>' );

		}

	});

	// open in lightbox
	$('.open-in-lightbox').magnificPopup({ type : 'image' });

});

/**
 * # load
 */
jQuery(window).load(function(){

	// hide the overlay
	jQuery('#page-overlay').hide();

	// post count
	if ( jQuery('.wonderwall-magazine-count-views').length ) {

		var postID = jQuery('.wonderwall-magazine-count-views').data('post-id');

		jQuery.post(
			DDAjax.ajaxurl,
			{
				action : 'wonderwall-magazine-increment-viewcount',
				dd_post_id : postID
			}
		);

	}

	// init carousel
	wonderwall_magazine_carousel();
	wonderwall_magazine_post_gallery_carousel();

	// init masonry
	wonderwall_magazine_masonry();

	// featured 7 center
	wonderwall_magazine_featured_7_center();

	// post header 3 center
	wonderwall_magazine_post_header_3_center();

	// serach overlay center
	wonderwall_magazine_search_overlay_center

	// adjacent post none height
	wonderwall_magazine_adjacent_post_none_height();

	// sticky sidebar
	if ( jQuery(window).width() > 767 ) {

		var scrollOffset = 20;
		if ( jQuery('body').hasClass('body-top-bar-sticky-enabled') ) {
			scrollOffset = 60;
		}

		jQuery('.module-wrapper .sidebar.sticky-sidebar-enabled, #sidebar.sticky-sidebar-enabled').stick_in_parent({ 'offset_top' : scrollOffset });

	}

	// sticky share
	if ( jQuery('.blog-post-single-share').length ) {

		// make sure the height of main is big enough
		jQuery('.blog-post-single-main').css({ 'min-height' : 'none' });
		var shareHeight = jQuery('.blog-post-single-share').height(),
		mainHeight = jQuery('.blog-post-single-main').height();

		if ( mainHeight < shareHeight ) {
			jQuery('.blog-post-single-main').css({ 'min-height' : shareHeight });
		}

		var element = jQuery('.blog-post-single-share'),
		originalY = element.offset().top,
		maximum = jQuery('.blog-post-single-main').offset().top + jQuery('.blog-post-single-main').outerHeight() - element.outerHeight() - originalY - parseInt( jQuery('.blog-post-single-share').css( 'padding-bottom' ) ),
		scrollOffset = 10;

		if ( jQuery('body').hasClass('body-top-bar-sticky-enabled') ) {
			scrollOffset = 50;
		}

		if ( jQuery('body').hasClass('admin-bar') ) {
			scrollOffset = scrollOffset + 30;
		}

		jQuery(window).on('scroll', function(event) {

			var scrollTop = jQuery(window).scrollTop() + scrollOffset;

			if ( scrollTop > originalY ) {
				var top = scrollTop - originalY;
				if ( top >= maximum ) {
					top = maximum;
				}
			} else {
				var top = 0;
			}

			element.css({ top: top });

		});
	
	}

	// navigation active line
	wonderwall_magazine_nav_active_line();
	jQuery(document).on( 'mouseenter', '#navigation .menu > li', function(){
		jQuery('.current-menu-item-hover').removeClass('current-menu-item-hover');
		jQuery(this).addClass('current-menu-item-hover');
		wonderwall_magazine_nav_active_line();
	}).on( 'mouseleave', '#navigation .menu > li', function(){
		jQuery(this).removeClass('current-menu-item-hover');
		wonderwall_magazine_nav_active_line();
	});

	// center in post s4
	jQuery('.post-s4-center').each(function(){

		var container = jQuery(this),
		element = container.find('.post-s4-main'),
		containerHeight = container.height(),
		elementHeight = element.height(),
		centerOffset = containerHeight / 2 - elementHeight / 2;

		element.css({ marginBottom : centerOffset });

	});

	// retina
	var retina = window.devicePixelRatio > 1;
	if ( retina ) {
		jQuery('body').addClass('retina');
		wonderwall_magazine_retina_img_replace();
	} else {
		jQuery('body').addClass('not-retina');		
	}

	// reload on resize ( start mode )
	var startMode;
	if ( window.matchMedia('(max-width: 479px)').matches )
		startMode = 'portrait';
	else if ( window.matchMedia('(min-width: 480px)').matches && window.matchMedia('(max-width: 767px)').matches )
		startMode = 'landscape';
	else if ( window.matchMedia('(min-width: 768px)').matches && window.matchMedia('(max-width: 1023px)').matches )
		startMode = 'tablet';
	else if ( window.matchMedia('(min-width: 1024px)').matches && window.matchMedia('(max-width: 1400px)').matches )
		startMode = 'monitor-small'
	else if ( window.matchMedia('(min-width: 1401px)').matches && window.matchMedia('(max-width: 1500px)').matches )
		startMode = 'monitor-medium';
	else
		startMode = 'big'

	// reload on resize ( apply start mode )
	jQuery('#page').data( 'start-mode', startMode);

	setTimeout( function(){
		jQuery('body').addClass('init-navigation-active-line');
	}, 200);

});

/**
 * # scroll
 */
jQuery(window).scroll(function(){

	// show scroll to top
	if ( jQuery('#go-to-top').length ) {
		if ( jQuery(this).scrollTop() > 100 ) {
			jQuery('#go-to-top').fadeIn( 300 );
		} else {
			jQuery('#go-to-top').fadeOut( 300 );
		}
	}

	// show fly in post
	if ( jQuery('.fly-in-post').length ) {

		var windowHeight = jQuery(window).height(),
		contentHeight = jQuery('.blog-post-single-main').height(),
		contentOffset = jQuery('.blog-post-single-main').offset().top,
		scrollTop = jQuery(window).scrollTop();

		if ( ( contentOffset - scrollTop + contentHeight - windowHeight ) < 0 ) {
			jQuery('.fly-in-post').addClass('active');
		} else {
			jQuery('.fly-in-post').removeClass('active');
		}

	}

});

/**
 * # resize
 */ 
jQuery(window).resize(function(){

	wonderwall_magazine_nav_active_line();
	wonderwall_magazine_featured_7_center();
	wonderwall_magazine_post_header_3_center();
	wonderwall_magazine_search_overlay_center();

	// center in post s4
	jQuery('.post-s4-center').each(function(){

		var container = jQuery(this),
		element = container.find('.post-s4-main'),
		containerHeight = container.height(),
		elementHeight = element.height(),
		centerOffset = containerHeight / 2 - elementHeight / 2;

		element.css({ marginBottom : centerOffset });

	});

	// reload on resize 
	if ( jQuery('#page.reloading').length < 1 ) {

		var startMode = jQuery('#page').data('start-mode');
		var currMode;

		// current mode
		if ( window.matchMedia('(max-width: 479px)').matches )
			currMode = 'portrait';
		else if ( window.matchMedia('(min-width: 480px)').matches && window.matchMedia('(max-width: 767px)').matches )
			currMode = 'landscape';
		else if ( window.matchMedia('(min-width: 768px)').matches && window.matchMedia('(max-width: 1023px)').matches )
			currMode = 'tablet';
		else if ( window.matchMedia('(min-width: 1024px)').matches && window.matchMedia('(max-width: 1400px)').matches )
			currMode = 'monitor-small'
		else if ( window.matchMedia('(min-width: 1401px)').matches && window.matchMedia('(max-width: 1500px)').matches )
			currMode = 'monitor-medium';
		else
			currMode = 'big'

		// refresh if start mode and current mode different
		if ( startMode != currMode ) {
			location.reload();
			jQuery('#page').addClass('reloading');
		}

	}

});