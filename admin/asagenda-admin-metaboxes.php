<?php

/**
 * The specifics admin metaboxes of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 */

/**
 * The specifics admin metaboxes of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
	add_action( 'add_meta_boxes', 'asagenda_Add_Metaboxes' );
	function asagenda_Add_Metaboxes() {
		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
	
		add_meta_box(
			'asagenda_dates_metabox', 
			__( 'Start &amp; End dates', 'asagenda' ), 
			'asagenda_Create_Dates_Metabox', 
			'asagenda', 
			'side', 
			'high'
		);

		add_meta_box( 
        	'asagenda_place_metabox',
			__( 'Place', 'asagenda' ),
			'asagenda_Create_Place_Metabox',
			'asagenda',
			'normal',
			'low' 
		);
    
	}

	function asagenda_Create_Dates_Metabox( $post ) {
		// Get existing dates
		$dateStart = get_post_meta( $post->ID, 'asagenda_date_start', true );
		$dateEnd = get_post_meta( $post->ID, 'asagenda_date_end', true );
 
		// Nonce field for security
		wp_nonce_field( plugin_basename(__FILE__), 'asagenda_metabox_nonce');
		
		// Compare dates and get messages
		$today = date('Ymd');
		if ($dateEnd != '') {
			if ($today > $dateEnd) {
	    		// Finished event
				$messageBoxEnd = '<p style="color: #c00;">' . __('This event no longer appears in the calendar because it is finished. You can change the dates if necessary.') . '</p>';
	    	} else {
	    		// Upcoming event
				$messageBoxUpcoming = '<p style="color: #0c0;">' . __('This event is displayed in the calendar. You can change the dates if necessary.') . '</p>';
	    	}
		}
		?>
		<p><em><?php echo __('If it’s a single day event, use the same value for both start and end dates.') ?></em></p>
		<p><label fr="date-start"><?php echo __('Start date') ?></label><br /><input id="date-start" name="date-start" type="text" value="<?php if ($dateStart) { echo substr($dateStart,6,2).'/'.substr($dateStart,4,2).'/'.substr($dateStart,0,4); } ?>" /></p>
		<p><label fr="date-end"><?php echo __('End date') ?></label><br /><input id="date-end" name="date-end" type="text" value="<?php if ($dateEnd) { echo substr($dateEnd,6,2).'/'.substr($dateEnd,4,2).'/'.substr($dateEnd,0,4); } ?>" /></p>
		<?php if (isset($messageBoxEnd)) { echo $messageBoxEnd; } ?>
		<?php if (isset($messageBoxUpcoming)) { echo $messageBoxUpcoming; } ?>
		<?php
	}

	// Add or update post metas on Save
	add_action( 'save_post', 'asagenda_Save_Dates_Metabox');
	function asagenda_Save_Dates_Metabox($post_id) {
 		if ( isset($_POST['date-start']) && !empty($_POST['date-start']) ) {
	 		$dateStart = $_POST['date-start'];
	 		$formatedDateStart = explode("/", $dateStart);
	 		$formatedDateStart = $formatedDateStart[2].$formatedDateStart[1].$formatedDateStart[0];
	 		add_post_meta($post_id, 'asagenda_date_start', $formatedDateStart, true);
	 		update_post_meta($post_id, 'asagenda_date_start', $formatedDateStart);
	 		// Sorting var
	 		$formatedDateStartSort = explode("/", $dateStart);
	 		$formatedDateStartSort = $formatedDateStartSort[2].$formatedDateStartSort[1].$formatedDateStartSort[0];
	 		add_post_meta($post_id, 'asagenda_date_start_sort', $formatedDateStartSort, true);
	 		update_post_meta($post_id, 'asagenda_date_start_sort', $formatedDateStartSort);
	 	} else {
	 		add_post_meta($post_id, 'asagenda_date_start', '', true);
	 		update_post_meta($post_id, 'asagenda_date_start', '');
	 		add_post_meta($post_id, 'asagenda_date_start_sort', '', true);
	 		update_post_meta($post_id, 'asagenda_date_start_sort', '');
	 	}
	 	
 		if ( isset($_POST['date-end']) && !empty($_POST['date-end']) ) {
 			$dateEnd = $_POST['date-end'];
 			$formatedDateEnd = explode("/", $dateEnd);
 			$formatedDateEnd = $formatedDateEnd[2].$formatedDateEnd[1].$formatedDateEnd[0];
 			add_post_meta($post_id, 'asagenda_date_end', $formatedDateEnd, true);
 			update_post_meta($post_id, 'asagenda_date_end', $formatedDateEnd);
 		} else {
 			add_post_meta($post_id, 'asagenda_date_end', '', true);
 			update_post_meta($post_id, 'asagenda_date_end', '');
 		}
	}


	function asagenda_Create_Place_Metabox( $post ) {
	
	}
