<?php

/**
 * The Header Promotional Bar functionality of the plugin.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */

/**
 * The Header Promotional Bar functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the Header Promotional Bar stylesheet and JavaScript.
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */
class Cro_Booster_Header_Promotional_Bar {

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

		add_action('cro_options_fields', array($this, 'header_promotional_bar_fields'));

		if( isset( $this->cro_options['hpb_switcher'] ) && $this->cro_options['hpb_switcher'] == "yes"){
			if( !empty( $this->cro_options['hpb_message'] ) && !empty( $this->cro_options['hpb_bg_color'] ) && !empty( $this->cro_options['hpb_text_color'] ) ){

				add_action('wp_body_open', array($this, 'header_promotional_bar_view'));
				add_action('cro_styles', array($this, 'cro_styles'));

			}
		}
	} 
	 
	/**
	 * Register the new field for the Header Promotional Bar side of the site.
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
            'name'   => 'header-promotional-bar',
            'title'  => __('Header Promotional Bar', "cro-booster"),
            'fields' => array(

            	array(
                    'id'      => 'hpb_switcher',
                    'type'    => 'switcher',
                    'title'   => __('Enable/Disable', "cro-booster"),
                    'label'   => __('Enable this option to display Header Promotional Bar', "cro-booster"),
                ),

            	array(
                    'id'          => 'hpb_message',
                    'type'        => 'editor',
                    'title'       => __('Message', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => 'Free Shipping on all orders over <strong>$100</strong>',
                ), 

                array(
                    'id'     => 'hpb_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#000000',

                ),

                array(
                    'id'     => 'hpb_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#ffffff',
                ),

            ),
        );
        
        return $fields;

	}

	/**
	 * Adding code for the Header Promotional Bar side of the site.
	 *
	 * @since    1.0.0
	 */
	public function header_promotional_bar_view() {

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
		
		?>
		<div class="cro-booster-hpb">
			<div class="cro-inside"><?php _e( wp_kses_post($this->cro_options['hpb_message']), "cro-booster" );?></div>
		</div>
		<?php

	}

	/**
	 * Adding code for the Header Promotional Bar side of the site.
	 *
	 * @since    1.0.0
	 */
	public function cro_styles() {

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
		?>
			.cro-booster-hpb{
				text-align:center;
				font-size: 17px;
				padding: 5px 0;
			    color: <?php _e($this->cro_options['hpb_text_color'], "cro-booster");?>;
			    background-color: <?php _e($this->cro_options['hpb_bg_color'], "cro-booster");?>
			}
		<?php

	}



}


new Cro_Booster_Header_Promotional_Bar( Cro_Booster::get_plugin_name(), Cro_Booster::get_version(), Cro_Booster::get_cro_options() );