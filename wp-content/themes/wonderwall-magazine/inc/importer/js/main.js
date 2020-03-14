jQuery(document).ready(function($){

	function initiateImport( progressItem, all ) {

		all = typeof all !== 'undefined' ? all : false;

		funcName = 'wonderwall-magazine-ajax-' + progressItem.data('wonderwall-magazine-func-name');

		jQuery('.wonderwall-magazine-importer-row').show();
		progressItem.show();
		progressItem.find('span').show();

		jQuery.post(

			WonderwallMagazineImporterAjax.ajaxurl,
			{
				action : funcName,
			},
			function( response ) {

				if ( response.status == 'success' ) {
					progressItem.find('strong').show();
				} else {
					alert( 'Something went wrong, please try again.' );
				}

				if ( progressItem.next('.wonderwall-magazine-importer-progress-item').length ) {
					initiateImport( progressItem.next('.wonderwall-magazine-importer-progress-item'), all );
				} else {
					progressItem.after('<hr><strong>All Finished</strong>');
					progressItem.closest('.wonderwall-magazine-importer-row').find('.wonderwall-magazine-importer-hook').text('Installed');
					if ( all ) {
						if ( progressItem.closest('.wonderwall-magazine-importer-row').next('.wonderwall-magazine-importer-row').length ) {
							initiateImport( progressItem.closest('.wonderwall-magazine-importer-row').next('.wonderwall-magazine-importer-row').find('.wonderwall-magazine-importer-progress-item:first-child'), all );
						}
					}
				}

			}

		);

	}

	function initiateImportAll() {

		initiateImport( jQuery('.wonderwall-magazine-importer-row .wonderwall-magazine-importer-progress-item:first-child'), true );

	}

	jQuery(document).on( 'click', '.wonderwall-magazine-importer-hook:not(.button-disabled)', function(e){

		e.preventDefault();

		var _this = jQuery(this),
		progress = _this.closest('.wonderwall-magazine-importer-row').find('.wonderwall-magazine-importer-progress'),
		funcName,
		progressItem;

		// Disable button
		_this.hide();

		// Initiate Import
		initiateImport( progress.find('.wonderwall-magazine-importer-progress-item:first-child'), false );

	});

	jQuery(document).on( 'click', '.wonderwall-magazine-importer-all-hook:not(.button-disabled)', function(e){

		e.preventDefault();

		var _this = jQuery(this);

		// Disable button
		_this.hide()

		// Initiate Import
		initiateImportAll();

	});

	jQuery(document).on( 'click', '.wonderwall-magazine-importer-close-hook', function(e){

		e.preventDefault();		

		jQuery.post(

			WonderwallMagazineImporterAjax.ajaxurl,
			{
				action : 'wonderwall-magazine-ajax-close-installer'
			},
			function( response ) {

				if ( response.status == 'success' ) {
					jQuery('.wonderwall-magazine-importer').slideUp( 200 );
				}

			}

		);

	});
	

});