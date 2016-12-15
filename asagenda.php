<?php

/**
 * @link              http://jeanbaptisteaudras.com
 * @since             1.0.0
 * @package           AsAgenda
 *
 * @wordpress-plugin
 * Plugin Name:       A simple Agenda
 * Plugin URI:        http://jeanbaptisteaudras.com/a-simple-agenda
 * Description:       A (really) simple way to manage and display events in your own agenda. Made with love for WordPress users.
 * Version:           1.0.0
 * Author:            audrasjb
 * Author URI:        http://jeanbaptisteaudras.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       asagenda
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Custom variables
$plugin_version = '1.0.0';
$plugin_name = 'asagenda';

/**
 * The code that runs during plugin activation.
*/
//require_once plugin_dir_path( __FILE__ ) . 'includes/asagenda-activator.php';
//register_activation_hook( __FILE__, 'activate_asagenda' );

/**
 * The code that runs during plugin deactivation.
 */
//require_once plugin_dir_path( __FILE__ ) . 'includes/asagenda-deactivator.php';
//register_deactivation_hook( __FILE__, 'deactivate_asagenda' );

/**
 * The class responsible for defining internationalization functionality
 * of the plugin.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/includes/asagenda-i18n.php';

/**
 * The class responsible for defining all actions that occur in the admin area.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/admin/asagenda-admin.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/admin/asagenda-admin-metaboxes.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/admin/asagenda-admin-widget-listview.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/admin/asagenda-admin-widget-calendarview.php';

/**
 * The class responsible for defining all actions that occur in the public-facing
 * side of the site.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/public/asagenda-public.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/public/asagenda-public-shortcode-listview.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . '/' .$plugin_name . '/public/asagenda-public-shortcode-calendarview.php';
