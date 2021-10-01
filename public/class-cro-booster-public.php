<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/public
 */
class Cro_Booster_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The saved options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cro_options    The saved options of this plugin.
	 */
	private $cro_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $cro_options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->cro_options = $cro_options;

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
		 * defined in Cro_Booster_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cro_Booster_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cro-booster-public.css.php', array(), $this->version, 'all' );

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
		 * defined in Cro_Booster_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cro_Booster_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( $this->plugin_name . '-countdown', plugin_dir_url( __FILE__ ) . 'js/simplyCountdown.js', array( 'jquery' ), $this->version, false );

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cro-booster-public.js', array( 'jquery' ), $this->version, false );

		if( !empty( $this->cro_options['hpbwc_date'] ) && !empty( $this->cro_options['hpbwc_time'] ) ) {
			wp_localize_script($this->plugin_name, 'cro_booster_object',
	            array( 
	                'hpbwc_date' => $this->cro_options['hpbwc_date'],
	                'hpbwc_time' => $this->cro_options['hpbwc_time'],
	            )
	        );
		}



	}

}
