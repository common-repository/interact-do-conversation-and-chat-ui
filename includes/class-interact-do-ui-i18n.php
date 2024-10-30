<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://interact.do/plugins/wordpress/interact-do-ui/
 * @since      1.0.0
 *
 * @package    interact-do-ui
 * @subpackage Interact_Do_Ui/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    interact-do-ui
 * @subpackage Interact_Do_Ui/includes
 * @author     Jeremy de Oliveira-Kumar <interact@interact.do>
 */
class Interact_Do_Ui_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'interact-do-ui',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
