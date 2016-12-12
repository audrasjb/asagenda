<?php

/**
 * The specifics admin tinymce button for generate the shortcodes of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 */

/**
 * The specifics admin tinymce button for generate the shortcodes of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
   
 
 	add_action( 'admin_init', 'asgenda_tinymce_buttons' );
 	function asgenda_tinymce_buttons() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	        return false;
		}
		if ( get_user_option('rich_editing') == 'true') {
			add_filter( 'mce_external_plugins', 'asagenda_scripts_tinymce_buttons' );
			add_filter( 'mce_buttons', 'asagenda_register_buttons' );
		}
	}

	function asagenda_scripts_tinymce_buttons( $plugin_array ) {
		$plugin_array['asgenda_tinymce_buttons'] = plugins_url( 'js/asagenda-tinymce-buttons.js', __FILE__ );
		return $plugin_array;
	}

	function asagenda_register_buttons( $buttons ) {
		array_push( $buttons, '|', 'asagenda_listview' );
		array_push( $buttons, '|', 'asagenda_calendarview' );
		return $buttons;
	}

	// AsAgenda buttons CSS
	add_action( 'admin_init', 'add_asagenda_buttons_styles_to_editor' );
	function add_asagenda_buttons_styles_to_editor() {
		global $editor_styles;
		$editor_styles[] = plugin_dir_url( 'css/asagenda-tinymce-buttons.css', __FILE__ );
	}