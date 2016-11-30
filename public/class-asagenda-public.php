<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 * @author     audrasjb <audrasjb@gmail.com>
 */
	function enqueue_styles() {

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

		wp_enqueue_style( 'asgenda', plugin_dir_url( __FILE__ ) . 'css/asagenda-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function enqueue_scripts() {

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

		wp_enqueue_script( 'asagenda', plugin_dir_url( __FILE__ ) . 'js/asagenda-public.js', array( 'jquery' ), $this->version, false );

	}

}
