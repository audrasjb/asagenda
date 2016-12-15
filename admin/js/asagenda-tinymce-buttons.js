(function( $ ) {
	'use strict';

	tinymce.PluginManager.add('asagenda_shortcodes', function( editor, url ) {
		editor.addButton('asagenda', {
			title: 'Agenda shortcodes',
			id: 'asagenda_shortcode_button',
			cmd: 'asagenda_shortcodes_modal'
		});

		editor.addCommand( 'asagenda_shortcodes_modal', function() {
			console.log('buttonpressed!');
		});
	});
		
})( jQuery );
