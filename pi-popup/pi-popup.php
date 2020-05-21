<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://www.quemalabs.com/
 * @since             1.0.0
 * @package           Pi_Popup
 *
 * @wordpress-plugin
 * Plugin Name:       Pi Popup
 * Plugin URI:        https://www.quemalabs.com/plugin/pi-popup/
 * Description:       Attractive popup forms on exit intent to convert visitors into subscribers.
 * Version:           1.1.1
 * Author:            Quema Labs
 * Author URI:        https://www.quemalabs.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pi-popup
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pi-popup-activator.php
 */
function activate_pi_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pi-popup-activator.php';
	Pi_Popup_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pi-popup-deactivator.php
 */
function deactivate_pi_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pi-popup-deactivator.php';
	Pi_Popup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pi_popup' );
register_deactivation_hook( __FILE__, 'deactivate_pi_popup' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pi-popup.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pi_popup() {

	static $pi_popup = null;

	if ( is_null( $pi_popup ) ) {
		$pi_popup = new Pi_Popup();
		$pi_popup->run();
	}
    return $pi_popup;
	
}
$GLOBALS['pi_popup_plugin_basename'] = plugin_basename( __FILE__ );
$GLOBALS['pi_popup'] = run_pi_popup();

