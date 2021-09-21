<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/admin
 */
class Cro_Booster_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the admin menu for the admin area.
	 *
	 * @since    1.0.0
	 */	
	public function create_menu() {

		/**
         * Create a menu page under Plugins.
         * Framework also add "Settings" to your plugin in plugins list.
         * @link https://github.com/JoeSz/Exopite-Simple-Options-Framework
         */
        $config_menu = array(

            'type'              => 'menu',                          // Required, menu or metabox
            'id'                => $this->plugin_name,              // Required, meta box id, unique per page, to save: get_option( id )
            // 'parent'            => 'plugins.php',                   // Parent page of plugin menu (default Settings [options-general.php])
            'submenu'           => false,                            // Required for submenu
            'menu_title'             => 'CRO Booster',               // The title of the options page in admin menu
            'title'             => 'CRO Booster Options',               // The title of the options page and the name in admin menu
            'capability'        => 'manage_options',                // The capability needed to view the page
            'plugin_basename'   =>  plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' ),
            // 'tabbed'            => false,
            'multilang'         => false,                        // To turn of multilang, default on.

        );

        /*
        $fields[] = array(
            'name'   => 'basic',
            'title'  => 'Basic',
            'icon'   => 'dashicons-admin-generic',
            'fields' => array(


                array(
                    'id'          => 'text_1',
                    'type'        => 'text',
                    'title'       => 'Text',
                    'before'      => 'Text Before',
                    'after'       => 'Text After',
                    'class'       => 'text-class',
                    'description' => 'Description',
                    'default'     => 'Default Text',
                    'attributes'    => array(
                       'placeholder' => 'do stuff',
                       'data-test'   => 'test',

                    ),
                    'help'        => 'Help text',
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ),

                array(
                    'id'     => 'test_disabled',
                    'type'   => 'text',
                    'title'  => 'Disabled',
                    'attributes'     => array(
                    'placeholder' => 'This is a diabled element',
                    'disabled'    => 'disabled',

                    ),
                ),

                array(
                    'id'      => 'text_icon',
                    'type'    => 'text',
                    'title'   => 'Text',
                    'prepend' => 'fa-font',
                    'append'  => 'Char',
                ),

                array(
                    'id'     => 'password_1',
                    'type'   => 'password',
                    'title'  => 'Password',
                ),



                array(
                    'type'    => 'content',
                    'wrap_class'   => 'no-border-bottom', // for all fieds
                    'title'   => 'Content Title',
                    'content' => 'You can "group" element together, by adding the class <code>no-border-bottom</code> to the <code>wrap_class</code>.',
                    'before' => 'Before Text',
                    'after'  => 'After Text',
                ),

                array(
                    'id'    => 'image_1',
                    'type'  => 'image',
                    'title' => 'Image',
                ),


                array(
                    'id'      => 'switcher_1',
                    'type'    => 'switcher',
                    'title'   => 'Switcher',
                    'label'   => 'You want to do this?',
                    'default' => 'yes',
                ),


                array(
                    'id'      => 'hidden_1',
                    'type'    => 'hidden',
                    'default' => 'hidden',
                ),

                array(
                    'id'    => 'checkbox_1',
                    'type'  => 'checkbox',
                    'title' => 'Checkbox',
                    'label' => 'Did you like this framework ?',
                    'after' => '<i>If you check this and the other checkbox, a text field will appier.</i>'
                ),

                array(
                    'id'    => 'checkbox_2',
                    'type'  => 'checkbox',
                    'title' => 'Checkbox Fancy',
                    'label' => 'Do you want to do this?',
                    'style'    => 'fancy',
                ),

                array(
                    'id'     => 'text_2',
                    'type'   => 'text',
                    'title'  => 'Text Test Dependency',
                    'dependency' => array( 'checkbox_1|checkbox_2', '==|==', 'true|true' ),
                    'attributes'    => array(
                        'placeholder' => 'Dependency test',
                    ),
                ),

                array(
                  'id'      => 'radio_1',
                  'type'    => 'radio',
                  'title'   => 'Radio',
                  'options' => array(
                    'yes'   => 'Yes, Please.',
                    'no'    => 'No, Thank you.',
                  ),
                  'default' => 'no',
                ),

                array(
                  'id'      => 'radio_2',
                  'type'    => 'radio',
                  'title'   => 'Radio Fancy',
                  'options' => array(
                    'yes'   => 'Yes, Please.',
                    'no'    => 'No, Thank you.',
                  ),
                  'default' => 'no',
                  'style'    => 'fancy',
                ),

                array(
                    'id'      => 'test_unknown_1',
                    'type'    => 'test_unknown_type',
                    'title'   => 'Test Unknown Element',
                ),


            )
        );
	   */
		
        $fields = array();
        $fields = apply_filters( 'cro_options_fields', $fields);

		$options_panel = new Exopite_Simple_Options_Framework( $config_menu, $fields );
	}	


    public function test_sanitize_callback( $val ) {
        return str_replace ( 'a', 'b', $val );
    }
    
	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cro-booster-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cro-booster-admin.js', array( 'jquery' ), $this->version, false );

	}

}
