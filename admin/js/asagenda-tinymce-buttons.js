(function( $ ) {
	'use strict';

	tinymce.PluginManager.add('asagenda_listview', function( editor, url ) {
		editor.addButton('asagenda', {
			title: 'Agenda shortcodes',
			id: 'asagenda_calendar',
			cmd: 'asagenda_calendar',
			onclick: function () {
		    	editor.insertContent('[asagenda-list]');
		    }
		});
	});
		
})( jQuery );
