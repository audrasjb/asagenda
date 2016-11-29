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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/admin
 * @author     audrasjb <audrasjb@gmail.com>
 */
class Asagenda_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Asagenda_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Asagenda_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/asagenda-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Asagenda_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Asagenda_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/asagenda-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Register our custom post type for the admin area.
	 *
	 * @since    1.0.0
	 */
	public static function asagenda_Init_CPT() {
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
}