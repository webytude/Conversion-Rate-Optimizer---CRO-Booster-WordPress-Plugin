<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://webytude.com/
 * @since             1.0.0
 * @package           Cro_Booster
 *
 * @wordpress-plugin
 * Plugin Name:       CRO Booster - Conversion Rate Optimization Pack
 * Plugin URI:        http://webytude.com/
 * Description:       CRO Booster plugin helps with several conversion rate optimization tactics that helps to increase more sales/ leads on the website.
 * Version:           1.0.0
 * Author:            Webytude
 * Author URI:        http://webytude.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cro-booster
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CRO_BOOSTER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cro-booster-activator.php
 */
function activate_cro_booster() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cro-booster-activator.php';
	Cro_Booster_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cro-booster-deactivator.php
 */
function deactivate_cro_booster() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cro-booster-deactivator.php';
	Cro_Booster_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cro_booster' );
register_deactivation_hook( __FILE__, 'deactivate_cro_booster' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cro-booster.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cro_booster() {

	$plugin = new Cro_Booster();
	$plugin->run();

}
run_cro_booster();
