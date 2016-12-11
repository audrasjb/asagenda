<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
	// Enqueue styles
	add_action( 'admin_enqueue_scripts', 'enqueue_styles' );
	function enqueue_styles() {
		wp_enqueue_style( 'asagenda-jquery-ui-datepicker-style', plugin_dir_url( __FILE__ ) . 'css/asagenda-jquery-ui.css', array(), '', 'all' );
		wp_enqueue_style( 'asagenda', plugin_dir_url( __FILE__ ) . 'css/asagenda-admin.css', array(), '', 'all' );
	}
	
	// Enqueue scripts
	add_action( 'admin_enqueue_scripts', 'enqueue_scripts' );
	function enqueue_scripts() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'asagenda', plugin_dir_url( __FILE__ ) . 'js/asagenda-admin.js', array( 'jquery' ), '', false );
	}
	
	// CPT
	add_action('init', 'asagenda_Init_CPT');
	function asagenda_Init_CPT() {
		$labels = array(
	    	'name' => __('Agenda', 'asagenda'),
			'singular_name' => __('Event', 'asagenda'),
			'add_new' => __('Add new', 'asagenda'),
			'add_new_item' => __('Add new event', 'asagenda'),
			'edit_item' => __('Edit event', 'asagenda'),
			'new_item' => __('New event', 'asagenda'),
			'all_items' => __('All events', 'asagenda'),
			'view_item' => __('View event', 'asagenda'),
			'search_items' => __('Search events', 'asagenda'),
			'not_found' =>  __('No event found', 'asagenda'),
			'not_found_in_trash' => __('No event found in trash', 'asagenda'), 
			'parent_item_colon' => '',
			'menu_name' => __('Agenda', 'asagenda')
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'agenda' ),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => 20,
			'menu_icon' => 'dashicons-calendar',
			'supports' => array( 'title', 'editor' )
		); 
		// Enregistrement du TCP
		register_post_type( 'asagenda', $args );
	}
	
	/**
	 * Register our custom hooks to display edit list table for this CPT.
	 *
	 * @since    1.0.0
	 */
	// Pour créer un filtre sur les métadonnées ou autres, voir : http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types

	add_filter( 'manage_asagenda_posts_columns', 'asagenda_Init_EditTable_Columns_Header' ) ;
	function asagenda_Init_EditTable_Columns_Header($columns) {
		// Colums headers
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title', 'asagenda' ),
			'author' => __( 'Author', 'asagenda' ),
			'asagenda_date_start' => __('Start date', 'asagenda' ), 
			'asagenda_date_end' => __('End date', 'asagenda' ),
			'date' => __( 'Date of publishing', 'asagenda' )
		);
		return $columns;
	}

	// Fill the columns of the edit table
	add_action( 'manage_asagenda_posts_custom_column', 'asagenda_Init_EditTable_Columns_Content', 10, 2 );		
	function asagenda_Init_EditTable_Columns_Content( $column, $post_id ) {
		global $post;
		switch( $column ) {
			case 'asagenda_date_start' :
				$dateDebut = get_post_meta($post_id, 'asagenda_date_start', true);
				if ($dateDebut) {
					echo substr($dateDebut,6,2).'/'.substr($dateDebut,4,2).'/'.substr($dateDebut,0,4);
				} else {
					echo __('The date is empty. This content can not be displayed in the calendar.');
				}
			break;
			case 'asagenda_date_end' :
				$today = date('Ymd');
				$dateEnd = get_post_meta($post_id, 'asagenda_date_end', true);
				$formatedDateEnd = substr($dateEnd,6,2).'/'.substr($dateEnd,4,2).'/'.substr($dateEnd,0,4);
				if ($dateEnd) {
					if ( $today > $dateEnd) {
						echo '<span class="list-date-finished">'.$formatedDateEnd.' (' . __('completed') . ')</span>';
					} else {
						echo '<span class="list-date-not-finished">'.$formatedDateEnd.' (' . __('upcoming') . ')</span>';
					}
				} else {
					echo __('The date is empty. This content can not be displayed in the calendar.');
				}
			break;
			/* Break out */
			default :
			break;
		}
	}
	
