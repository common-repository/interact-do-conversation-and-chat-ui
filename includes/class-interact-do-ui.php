<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://interact.do/plugins/wordpress/interact-do-ui/
 * @since      1.0.0
 *
 * @package    interact-do-ui
 * @subpackage Interact_Do_Ui/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    interact-do-ui
 * @subpackage Interact_Do_Ui/includes
 * @author     Jeremy de Oliveira-Kumar <interact@interact.do>
 */
class Interact_Do_Ui {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Interact_Do_Ui_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $interact_do_ui    The string used to uniquely identify this plugin.
	 */
	protected $interact_do_ui;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'INTERACT_DO_UI_VERSION' ) ) {
			$this->version = INTERACT_DO_UI_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->interact_do_ui = 'interact-do-ui';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Interact_Do_Ui_Loader. Orchestrates the hooks of the plugin.
	 * - Interact_Do_Ui_i18n. Defines internationalization functionality.
	 * - Interact_Do_Ui_Admin. Defines all hooks for the admin area.
	 * - Interact_Do_Ui_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-interact-do-ui-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-interact-do-ui-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-interact-do-ui-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-interact-do-ui-public.php';

		$this->loader = new Interact_Do_Ui_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Interact_Do_Ui_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Interact_Do_Ui_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Interact_Do_Ui_Admin( $this->get_interact_do_ui(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        function register_settings() {
            $appIDArgs = array(
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => NULL,
                );

            register_setting( 'general', 'interact-do-ui_interaction_key', $appIDArgs );

            $contentSelectorArgs = array(
                            'type' => 'string',
                            'sanitize_callback' => 'sanitize_text_field',
                            'default' => NULL,
                            );

            register_setting( 'general', 'interact-do-ui_content_selector', $contentSelectorArgs );



            function general_settings_section( $args ) {
                echo '<p>You can find your Interaction Journey Settings here.';
                echo '<p>For your Interaction Key, refer to Option 1 when you deploy your Interaction Journey to get your Interaction Key if you do not see one pre-filled here.</p>';
                echo '<p>If you are embedding your Interaction Journey within the content of your page, use the content selector to define the location to embed the journey.</p>';
            }

            add_settings_section(
                'interact-do-ui_general_settings',
                'Your Interaction Journey Settings',
                'general_settings_section',
                'general'
            );

            function interaction_key_value($args){
                $setting = get_option('interact-do-ui_interaction_key');
                echo '<input type="text" name="interact-do-ui_interaction_key" value="' . (isset( $setting ) ? esc_attr( $setting ) : '') . '">';
            }

            add_settings_field( 'interact-do-ui_interaction_key',
                'Interaction Key',
                'interaction_key_value',
                'general',
                'interact-do-ui_general_settings',
                array( 'label_for' => 'interact-do-ui_interaction_key' ) );


            function content_selector_value($args){
                $setting = get_option('interact-do-ui_content_selector');
                echo '<input type="text" name="interact-do-ui_content_selector" value="' . (isset( $setting ) ? esc_attr( $setting ) : '') . '">';
            }

            add_settings_field( 'interact-do-ui_content_selector',
                'Content Selector',
                'content_selector_value',
                'general',
                'interact-do-ui_general_settings',
                array( 'label_for' => 'interact-do-ui_content_selector' ) );
        }

        add_action( 'admin_init', 'register_settings' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Interact_Do_Ui_Public( $this->get_interact_do_ui(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_interact_do_ui() {
		return $this->interact_do_ui;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Interact_Do_Ui_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
