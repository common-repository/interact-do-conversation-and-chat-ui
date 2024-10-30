<?php

/**
 * Embed Interact.do UI
 *
 * @link              https://interact.do/plugins/wordpress/interact-do-ui/
 * @since             1.0.0
 * @package           interact-do-ui
 * @author            Jeremy de Oliveira-Kumar
 * @copyright         2021 Interact.do
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Interact.do Conversation and Chat UI
 * Plugin URI:        https://interact.do/plugins/wordpress/interact-do-ui/
 * Description:       A WordPress plugin to embed Interact.do into your WordPress site
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jeremy de Oliveira-Kumar <interact@interact.do>
 * Author URI:        https://interact.do
 * Text Domain:       interact-do-ui
 * Domain Path:       /interact-do-ui
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
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
define( 'INTERACT_DO_UI_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-interact-do-ui-activator.php
 */
function activate_interact_do_ui() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-interact-do-ui-activator.php';
	Interact_Do_Ui_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-interact-do-ui-deactivator.php
 */
function deactivate_interact_do_ui() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-interact-do-ui-deactivator.php';
	Interact_Do_Ui_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_interact_do_ui' );
register_deactivation_hook( __FILE__, 'deactivate_interact_do_ui' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-interact-do-ui.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_interact_do_ui() {

	$plugin = new Interact_Do_Ui();
	$plugin->run();

}
run_interact_do_ui();
