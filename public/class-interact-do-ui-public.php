<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://interact.do/plugins/wordpress/interact-do-ui/
 * @since      1.0.0
 *
 * @package    interact-do-ui
 *
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    interact-do-ui
 *
 * @author     Jeremy de Oliveira-Kumar <interact@interact.do>
 */
class Interact_Do_Ui_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $interact_do_ui    The ID of this plugin.
	 */
	private $interact_do_ui;

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
	 * @param      string    $interact_do_ui       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $interact_do_ui, $version ) {

		$this->interact_do_ui = $interact_do_ui;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Interact_Do_Ui_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Interact_Do_Ui_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->interact_do_ui, plugin_dir_url( __FILE__ ) . 'css/interact-do-ui-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Interact_Do_Ui_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Interact_Do_Ui_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


        wp_register_script( 'some_handle', 'path/to/myscript.js' );

		wp_enqueue_script( $this->interact_do_ui, plugin_dir_url( __FILE__ ) . 'js/interact-do-ui-public.js', array( 'jquery' ), $this->version, false );

        function localize_vars() {
            $strings = array(
                'interaction_key'    => get_option('interact-do-ui_interaction_key'),
                'content_selector' => get_option('interact-do-ui_content_selector'),
            );

            return $strings;
        }

        wp_localize_script( $this->interact_do_ui, 'wp_interact_do_ui', localize_vars() );
	}

}
