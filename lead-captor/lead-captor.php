<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://www.quemalabs.com/
 * @since             1.0.0
 * @package           Lead_Captor
 *
 * @wordpress-plugin
 * Plugin Name:       Lead Captor
 * Plugin URI:        https://www.quemalabs.com/plugin/lead-captor/
 * Description:       Attractive popup forms on exit intent to convert visitors into subscribers.
 * Version:           1.1.1
 * Author:            Quema Labs
 * Author URI:        https://www.quemalabs.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lead-captor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lead-captor-activator.php
 */
function activate_lead_captor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lead-captor-activator.php';
	Lead_Captor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lead-captor-deactivator.php
 */
function deactivate_lead_captor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lead-captor-deactivator.php';
	Lead_Captor_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lead_captor' );
register_deactivation_hook( __FILE__, 'deactivate_lead_captor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lead-captor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lead_captor() {

	static $lead_captor = null;

	if ( is_null( $lead_captor ) ) {
		$lead_captor = new Lead_Captor();
		$lead_captor->run();
	}
    return $lead_captor;
	
}
$GLOBALS['lead_captor_plugin_basename'] = plugin_basename( __FILE__ );
$GLOBALS['lead_captor'] = run_lead_captor();

