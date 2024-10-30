(function( $ ) {
	'use strict';

	$.loadScript = function (url, callback) {
		$.ajax({
			url: url,
			dataType: 'script',
			success: callback,
			async: true
		});
	}

	$.loadScript('https://interact.do/shared/interact/load?k=' + wp_interact_do_ui.interaction_key + '&s=' + wp_interact_do_ui.content_selector, function() {});

})( jQuery );
