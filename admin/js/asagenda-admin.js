(function( $ ) {
	'use strict';

	// Datepicker
	$(function(){
		/* Admin scripts */
		$('#date-start').datepicker({
        	dateFormat: 'dd/mm/yy'
        });
		$('#date-end').datepicker({
        	dateFormat: 'dd/mm/yy'
        });
	});
	// Color picker
	$(function(){
		$('#asagenda-colorpicker').wpColorPicker();
    });
})( jQuery );
