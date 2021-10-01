<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/includes
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
 * @package    Cro_Booster
 * @subpackage Cro_Booster/includes
 */
class Cro_Booster {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Cro_Booster_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The saved options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cro_options    The saved options of this plugin.
	 */
	private $cro_options;

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
		if ( defined( 'CRO_BOOSTER_VERSION' ) ) {
			$this->version = CRO_BOOSTER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'cro-booster';		
		$this->cro_options = get_option($this->plugin_name);

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
	 * - Cro_Booster_Loader. Orchestrates the hooks of the plugin.
	 * - Cro_Booster_i18n. Defines internationalization functionality.
	 * - Cro_Booster_Admin. Defines all hooks for the admin area.
	 * - Cro_Booster_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cro-booster-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cro-booster-i18n.php';


		/**************************************
		 * EXOPITE SIMPLE OPTIONS FRAMEWORK
		 *
		 * Get Exopite Simple Options Framework
		 *
		 * @link https://github.com/JoeSz/Exopite-Simple-Options-Framework
		 * @link https://www.joeszalai.org/exopite/exopite-simple-options-framework/
		 *
		 * @tutorial app_option_page_for_plugin_with_options_framework.php
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/exopite-simple-options/exopite-simple-options-framework-class.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cro-booster-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cro-booster-public.php';


		/**
		 * The class responsible for defining all actions that occur in the header promotional bar
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tools/class-header-promotional-bar.php';

		/**
		 * The class responsible for defining all actions that occur in the header promotional bar With Button
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tools/class-header-promotional-bar-button.php';

		/**
		 * The class responsible for defining all actions that occur in the header promotional bar With Countdown
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tools/class-header-promotional-bar-countdown.php';



		$this->loader = new Cro_Booster_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cro_Booster_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cro_Booster_i18n();

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

		// exopite-simple-options
		$plugin_admin = new Cro_Booster_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'create_menu', 0 );
		
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles', 20 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', 20 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cro_Booster_Public( $this->get_plugin_name(), $this->get_version(), $this->get_cro_options() );

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
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Cro_Booster_Loader    Orchestrates the hooks of the plugin.
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

	/**
	 * Retrieve the options of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The options of the plugin.
	 */
	public function get_cro_options() {
		return $this->cro_options;
	}

}
