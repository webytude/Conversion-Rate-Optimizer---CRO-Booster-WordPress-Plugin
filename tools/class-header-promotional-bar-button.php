<?php

/**
 * The Header Promotional Bar With Button functionality of the plugin.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */

/**
 * The Header Promotional Bar With Button functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the Header Promotional Bar With Button stylesheet and JavaScript.
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */
class Cro_Booster_Header_Promotional_Bar_With_Button {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('cro_options_fields', array($this, 'header_promotional_bar_fields'));

	}

	/**
	 * Register the stylesheets for the Header Promotional Bar With Button side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cro-booster-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the Header Promotional Bar With Button side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cro-booster-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Register the new field for the Header Promotional Bar With Button side of the site.
	 *
	 * @since    1.0.0
	 */
	public function header_promotional_bar_fields( $fields ) {

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

		
		$fields[] = array(
            'name'   => 'header-promotional-bar-with-button',
            'title'  => 'Header Promotional Bar With Button',
            'icon'   => 'fa fa-bars',
            'fields' => array(

            	array(
                    'id'      => 'hpbwb_switcher',
                    'type'    => 'switcher',
                    'title'   => 'Enable/disable',
                    'label'   => 'Enable this option to display Promotional Bar into the header',
                    'default' => 'yes',
                ),

            	array(
                    'id'          => 'hpbwb_message',
                    'type'        => 'text',
                    'title'       => 'Promotional Bar Message',
                    'class'       => 'text-class',
                    'default'     => 'Default Text',
                    'attributes'    => array(
                       'placeholder' => 'Enter your promotional bar message'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ), 

                array(
                    'id'     => 'hpbwb_bg_color',
                    'type'   => 'color_wp',
                    'title'  => 'Promotional Bar Background Color',
                    'rgba'   => true,
                ),

                array(
                    'id'     => 'hpbwb_text_color',
                    'type'   => 'color_wp',
                    'title'  => 'Promotional Bar Text Color',
                    'rgba'   => true,
                ),

                array(
                    'id'          => 'hpbwb_btn_name',
                    'type'        => 'text',
                    'title'       => 'Button Name',
                    'class'       => 'text-class',
                    'default'     => 'Get Now',
                    'attributes'    => array(
                       'placeholder' => 'Enter your promotional button name'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ), 

                array(
                    'id'     => 'hpbwb_btn_bg_color',
                    'type'   => 'color_wp',
                    'title'  => 'Promotional Bar Button Background Color',
                    'rgba'   => true,
                ),

                array(
                    'id'     => 'hpbwb_btn_text_color',
                    'type'   => 'color_wp',
                    'title'  => 'Promotional Bar Button Text Color',
                    'rgba'   => true,
                ),

                array(
                    'id'          => 'hpbwb_btn_url',
                    'type'        => 'text',
                    'title'       => 'Button URL',
                    'class'       => 'text-class',
                    'attributes'    => array(
                       'placeholder' => 'Enter your promotional button URL'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ),


            ),
        );
        
        return $fields;

	}



}


new Cro_Booster_Header_Promotional_Bar_With_Button( Cro_Booster::get_plugin_name(), Cro_Booster::get_version() );