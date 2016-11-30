<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Asagenda
 * @subpackage Asagenda/includes
 * @author     audrasjb <audrasjb@gmail.com>
 */

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
		load_plugin_textdomain(
			'asagenda',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
