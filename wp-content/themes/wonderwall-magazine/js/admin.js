"use strict";

function wonderwall_magazine_module_opts() {

	dd_admin_repetable_labels();

	jQuery('#_wonderwall_magazine_home_sections_repeat .postbox').each(function(){

		var value = jQuery(this).find('.cmb-field-list > .cmb-row:first-child select').val();

		var container = jQuery(this),
		optSectionTitle = container.find('.cmb-row[class*="section-title"]'),
		optPostType = container.find('.cmb-row[class*="post-type"]'),
		optPostOrder = container.find('.cmb-row[class*="post-order"]'),
		optPostAmount = container.find('.cmb-row[class*="posts-per-page"]'),
		optPostBlogCategories = container.find('.cmb-row[class*="blog-categories"]'),
		optModule11 = container.find('.cmb-row[class*="module-11"]'),
		optModule12 = container.find('.cmb-row[class*="module-12"]'),
		optModulePromoBoxes = container.find('.cmb-row[class*="promo-box"]'),
		optModuleSubscribe = container.find('.cmb-row[class*="subscribe"]'),
		optModuleBanner = container.find('.cmb-row[class*="banner"]'),
		optModuleCustom = container.find('.cmb-row[class*="custom-content"]'),
		optPagination = container.find('.cmb-row[class*="pagination"]'),
		optExcludeTags = container.find('.cmb-row[class*="exclude-tags"]'),
		optStickySidebar = container.find('.cmb-row[class*="sticky-sidebar"]');

		var postType = optPostType.find('select').val();

		optModule11.hide();
		optModule12.hide();
		optModulePromoBoxes.hide();
		optModuleSubscribe.hide();
		optModuleBanner.hide();
		optModuleCustom.hide();
		optPagination.hide();

		optSectionTitle.show();
		optPostType.show();
		optPostOrder.show()
		optPostAmount.show();
		optPostBlogCategories.show();
		optExcludeTags.show();
		optStickySidebar.hide();

		if ( value == 'module-6' || value == 'module-11' || value == 'module-21' || value == 'module-22' || value == 'module-24' || value == 'module-26' ) {
			optStickySidebar.show();
		}

		if ( value == 'module-11' ) {
			optModule11.show();
		}

		if ( value == 'module-12' ) {
			optModule12.show();
		}

		if ( value == 'module-promo-boxes' || value == 'module-subscribe' || value == 'module-banner' || value == 'module-custom' ) { 
			optSectionTitle.hide();
			optPostType.hide();
			optPostOrder.hide()
			optPostAmount.hide();
			optPostBlogCategories.hide();
			optExcludeTags.hide();
			optStickySidebar.hide();
		}

		if ( value == 'module-promo-boxes' ) {
			optModulePromoBoxes.show();
		}

		if ( value == 'module-subscribe' ) {
			optModuleSubscribe.show();
		}

		if ( value == 'module-banner' ) {
			optModuleBanner.show();
		}

		if ( value == 'module-custom' ) {
			optModuleCustom.show();
		}

		if ( value == 'module-6' || value == 'module-7' || value == 'module-11' || value == 'module-12' || value == 'module-20' || value == 'module-21' || value == 'module-22' || value == 'module-23' || value == 'module-24' || value == 'module-25' || value == 'module-26' ) {
			optPagination.show();
		}


	});


}

jQuery(document).ready(function(){

	wonderwall_magazine_module_opts();
	jQuery(document).on( 'change', '#_wonderwall_magazine_home_sections_repeat .cmb-field-list > .cmb-row:first-child, .cmb-row[class*="post-type"] select', function(){
		wonderwall_magazine_module_opts();
	});

	/**
	 * On Load - Hide/Show 3 Col option based on layout
	 */
	jQuery('.cmb2_select#_wonderwall_magazine_layout').each(function(){

		var value = jQuery(this).val();

		if ( value == 'content_sidebar' ) {
			if ( jQuery('.cmb2_select#_wonderwall_magazine_columns').val() == '4' ) {
				jQuery('.cmb2_select#_wonderwall_magazine_columns').val( '6' );
			}
			jQuery('.cmb2_select#_wonderwall_magazine_columns option[value="4"]').attr('disabled','disabled');
		} else {
			jQuery('.cmb2_select#_wonderwall_magazine_columns option[value="4"]').removeAttr('disabled');
		}
		
	});

	/**
	 * On Change - Hide/Show 3 Col option based on layout
	 */
	jQuery(document).on('change', '.cmb2_select#_wonderwall_magazine_layout', function(){

		var value = jQuery(this).val();

		if ( value == 'content_sidebar' ) {
			if ( jQuery('.cmb2_select#_wonderwall_magazine_columns').val() == '4' ) {
				jQuery('.cmb2_select#_wonderwall_magazine_columns').val( '6' );
			}
			jQuery('.cmb2_select#_wonderwall_magazine_columns option[value="4"]').attr('disabled','disabled');
		} else {
			jQuery('.cmb2_select#_wonderwall_magazine_columns option[value="4"]').removeAttr('disabled');
		}

	});

});

/**
 * Add move up/down for repeatables
 */
function dd_admin_repeatable_sort() {
	jQuery('.cmb-repeatable-group .cmb-repeatable-grouping').prepend('<div class="wonderwall-magazine-admin-repeatable-sort"><span data-action="move-up">move up</span><span data-action="move-down">move down</span></div>');
}

function dd_admin_repetable_labels() {

	jQuery('.cmb-repeatable-group .cmb-repeatable-grouping').each(function(){

		if ( jQuery(this).find('.cmb-row[class*="section-title"] input').length ) {

			var module = jQuery(this).find('.cmb-field-list > .cmb-row:first-child select').val(),
			moduleTitle = jQuery(this).find('.cmb-field-list > .cmb-row:first-child select option:selected').text(),
			sectionTitle =  jQuery(this).find('.cmb-row[class*="section-title"] input').val(),
			newTitle = '';

			if ( module == 'module-promo-boxes' || module == 'module-subscribe' || module == 'module-banner' || module == 'module-custom' ) {
				newTitle = moduleTitle;
			} else {
				newTitle = moduleTitle + ' - ' + sectionTitle;
			}

			jQuery(this).find('.cmb-group-title').text( newTitle );

		}

	});

}

function dd_admin_repeatable_iterator() {

	var count = 0;

	jQuery('.cmb-repeatable-group .cmb-repeatable-grouping').each(function(){
		jQuery(this).data( 'iterator', count );
		count++;
	});

}

jQuery(document).ready(function(){

	dd_admin_repeatable_sort();
	dd_admin_repetable_labels();

	jQuery(document).on('click', '.wonderwall-magazine-admin-repeatable-sort span', function(){

		var direction = jQuery(this).data('action'),
		item = jQuery(this).closest('.cmb-repeatable-grouping'),
		prevItem = item.prev('.cmb-repeatable-grouping'),
		nextItem = item.next('.cmb-repeatable-grouping');

		if ( direction == 'move-up' && prevItem.length ) {
			item.find('.cmb-shift-rows.move-up').trigger('click');
			dd_admin_repetable_labels();
			wonderwall_magazine_module_opts();
		}

		if ( direction == 'move-down' && nextItem.length ) {
			item.find('.cmb-shift-rows.move-down').trigger('click');	
			dd_admin_repetable_labels();
			wonderwall_magazine_module_opts();
		}

	});

	jQuery(document).on( 'keyup', '.cmb-row[class*="section-title"] input', function(){
		dd_admin_repetable_labels();
	});	

});