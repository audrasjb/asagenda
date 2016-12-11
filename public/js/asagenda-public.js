(function( $ ) {
	'use strict';

	$(window).load( function() {
		$('#asagenda-widget-calendar-container').monthly({
			mode: 'event',
			dataType: 'json',
			events: asagendaJsonEvents,
			weekStart: 'Mon',
		});
	});

})( jQuery );
