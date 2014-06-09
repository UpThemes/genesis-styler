function preview_loaded(){
	document.getElementById('scss-loading').style.display = 'none';
}

jQuery(function($) {

	$(document).on( 'ready', function() {

		var $loading = $('<div id="scss-loading"></div>'),
			$span = $('<span/>');

		$span.appendTo($loading);

		$loading.hide();

		$('#customize-preview').append($loading);

		$('#accordion-section-colors').find('.wp-color-picker').not('#customize-control-background_color .wp-color-picker').each( function() {
			$(this).on('irischange', function() {
					$('#scss-loading').show();
			});
		});

		$('select[data-customize-setting-link]').on('change',function(){
			$('#scss-loading').show();
		});

	});

});