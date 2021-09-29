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

		if( isset( $this->cro_options['hpbwb_switcher'] ) && $this->cro_options['hpbwb_switcher'] == "yes"){
			if( !empty( $this->cro_options['hpbwb_message'] ) && !empty( $this->cro_options['hpbwb_bg_color'] ) && !empty( $this->cro_options['hpbwb_text_color'] ) ){

				add_action('wp_body_open', array($this, 'header_promotional_bar_view'));
				add_action('cro_styles', array($this, 'cro_styles'));

			}
		}
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
            'title'  => __('Header Promotional Bar With CTA Button', "cro-booster"),
            'fields' => array(

            	array(
                    'id'      => 'hpbwb_switcher',
                    'type'    => 'switcher',
                    'title'   => __('Enable/Disable', "cro-booster"),
                    'label'   => __('Enable this option to display Header Promotional Bar With CTA Button', "cro-booster"),
                ),

            	array(
                    'id'          => 'hpbwb_message',
                    'type'        => 'text',
                    'title'       => __('Promotional Bar Message', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => 'Black Friday BIG Sale Today | 80% Off - Unlimited Deals On Mobile & More',
                    'attributes'    => array(
                       'placeholder' => 'Enter your promotional bar message'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ), 

                array(
                    'id'     => 'hpbwb_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Promotional Bar Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#dd3333',
                ),

                array(
                    'id'     => 'hpbwb_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Promotional Bar Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#ffffff',
                ),

                array(
                    'id'          => 'hpbwb_btn_name',
                    'type'        => 'text',
                    'title'       => __('Button Name', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => 'Buy Now',
                    'attributes'    => array(
                       'placeholder' => 'Enter your promotional button name'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ), 

                array(
                    'id'     => 'hpbwb_btn_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Promotional Bar Button Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#000000',
                ),

                array(
                    'id'     => 'hpbwb_btn_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Promotional Bar Button Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#ffffff',
                ),

                array(
                    'id'     => 'hpbwb_hover_btn_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Promotional Bar Hover Button Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#ffffff',
                ),

                array(
                    'id'     => 'hpbwb_hover_btn_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Promotional Bar Hover Button Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#dd3333',
                ),

                array(
                    'id'          => 'hpbwb_btn_url',
                    'type'        => 'text',
                    'title'       => __('Button URL', "cro-booster"),
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

    /**
     * Adding code for the Header Promotional Bar With Button side of the site.
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
        <div class="cro-booster-hpbwb">
            <div class="cro-inside">
                <?php 
                _e( $this->cro_options['hpbwb_message'], "cro-booster" );

                if( !empty( $this->cro_options['hpbwb_btn_name'] ) && !empty( $this->cro_options['hpbwb_btn_url'] ) ) {

                    printf(
                        sprintf(
                          '<a href="%s" class="hpbwb-btn">%s</a>',
                          esc_url( $this->cro_options['hpbwb_btn_url'] ),
                          $this->cro_options['hpbwb_btn_name']
                        )
                    );
                }
                ?>                
            </div>
        </div>
        <?php

    }

    /**
     * Adding code for the Header Promotional Bar With Button side of the site.
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
            .cro-booster-hpbwb{
                text-align:center;
                font-size: 17px;
                padding: 5px 0;
                color: <?php _e($this->cro_options['hpbwb_text_color'], "cro-booster");?>;
                background-color: <?php _e($this->cro_options['hpbwb_bg_color'], "cro-booster");?>
            }
            .cro-booster-hpbwb .hpbwb-btn{
                margin-left: 10px;
                text-decoration: none;
                padding: 5px 15px;
                display: inline-block;
                border-radius: 3px;
                font-weight: bold;
                
                transition: all 0.3s;

                color: <?php _e($this->cro_options['hpbwb_btn_text_color'], "cro-booster");?>;
                background-color: <?php _e($this->cro_options['hpbwb_btn_bg_color'], "cro-booster");?>
            }
            .cro-booster-hpbwb .hpbwb-btn:hover,
            .cro-booster-hpbwb .hpbwb-btn:focus{
                color: <?php _e($this->cro_options['hpbwb_hover_btn_text_color'], "cro-booster");?>;
                background-color: <?php _e($this->cro_options['hpbwb_hover_btn_bg_color'], "cro-booster");?>
            }
        <?php

    }


}


new Cro_Booster_Header_Promotional_Bar_With_Button( Cro_Booster::get_plugin_name(), Cro_Booster::get_version(), Cro_Booster::get_cro_options() );