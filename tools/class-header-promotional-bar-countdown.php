<?php

/**
 * The Header Promotional Bar With Countdown functionality of the plugin.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */

/**
 * The Header Promotional Bar With Countdown functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the Header Promotional Bar With Countdown stylesheet and JavaScript.
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */
class Cro_Booster_Header_Promotional_Bar_With_Countdown {

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

		if( isset( $this->cro_options['hpbwc_switcher'] ) && $this->cro_options['hpbwc_switcher'] == "yes"){
			if( !empty( $this->cro_options['hpbwc_message'] ) && !empty( $this->cro_options['hpbwc_bg_color'] ) && !empty( $this->cro_options['hpbwc_text_color'] ) ){

				add_action('wp_body_open', array($this, 'header_promotional_bar_view'));
				add_action('cro_styles', array($this, 'cro_styles'));

			}
		}
	}

	/**
	 * Register the new field for the Header Promotional Bar With Countdown side of the site.
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
            'name'   => 'header-promotional-bar-with-countdown',
            'title'  => __('Header Promotional Bar With Urgency Creation', "cro-booster"),
            'fields' => array(

            	array(
                    'id'      => 'hpbwc_switcher',
                    'type'    => 'switcher',
                    'title'   => __('Enable/Disable', "cro-booster"),
                    'label'   => __('Enable this option to display Header Promotional Bar With CTA Button', "cro-booster"),
                ),

                array(
                    'id'     => 'hpbwc_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#fffae0',
                ),

                array(
                    'id'     => 'hpbwc_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#000000',
                ),

                array(
                    'id'          => 'hpbwc_date',
                    'type'   => 'date',
                    'title'  => __('Targeted Date', "cro-booster"),
                    'format' => 'yy-mm-dd',
                    'class'  => 'datepic-class',
                    'prepend' => 'fa-calendar',
                    'attributes'    => array(
                        'placeholder' => 'yyyy-mm-dd'

                    ),
                    'default'=> date("Y-m-d", strtotime(date("Y-m-d", current_time( 'timestamp' )) . " +1 week") ),
                ), 

                array(
                    'id'          => 'hpbwc_time',
                    'type'        => 'text',
                    'title'       => __('Targeted Time', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => '12:00:00',
                    'attributes'    => array(
                        'placeholder' => 'hh:mm:ss'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),
                    'description' => __('Use time in 24 hours format', "cro-booster"),
                    'after'       => __('Targeted Time for Promotion, No Need to Input AM/PM: format "hh:mm:ss"', "cro-booster"),
                ), 

                array(
                    'id'     => 'hpbwc_countdown_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Countdown Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#dd3333',
                ),

                array(
                    'id'     => 'hpbwc_countdown_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Countdown Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#ffffff',
                ),

            	array(
                    'id'          => 'hpbwc_message',
                    'type'        => 'text',
                    'title'       => __('Message', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => 'Hurry! Sale End In',
                    'attributes'    => array(
                       'placeholder' => 'Enter your promotional bar message'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ), 

                array(
                    'id'          => 'hpbwc_link_message',
                    'type'        => 'editor',
                    'title'       => __('Message with Link', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => sprintf('Limited Time: <strong><a href="%s">Grab Your Deal Now!</a></strong>', esc_url( site_url() ) )
                ), 

                array(
                    'id'     => 'hpbwc_link_message_color',
                    'type'   => 'color_wp',
                    'title'  => __('Message LINK Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#235af4',
                ),

                array(
                    'id'          => 'hpbwc_sale_tag',
                    'type'        => 'text',
                    'title'       => __('Sale Tag', "cro-booster"),
                    'class'       => 'text-class',
                    'default'     => '50% OFF',
                    'attributes'  => array(
                       'placeholder' => '50% OFF'

                    ),
                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

                ), 

                array(
                    'id'     => 'hpbwc_sale_tag_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Sale Tag Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#000000',
                ),

                array(
                    'id'     => 'hpbwc_sale_tag_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Sale Tag Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#fcffa9',
                ),

                array(
                    'id'     => 'hpbwc_sale_tag_border_color',
                    'type'   => 'color_wp',
                    'title'  => __('Sale Tag Border Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#aaaaaa',
                ),

            ),
        );
        
        return $fields;

	}

    /**
     * Adding code for the Header Promotional Bar With Countdown side of the site.
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
        <div class="cro-booster-hpbwc">
            <div class="cro-inside">
                <?php 

                if( !empty( $this->cro_options['hpbwc_message'] ) ) {
                    echo sprintf('<div class="hpbwc-message">%s</div>', esc_html__($this->cro_options['hpbwc_message']));
                }

                if( !empty( $this->cro_options['hpbwc_date'] ) && !empty( $this->cro_options['hpbwc_time'] ) ) {
                    $date = $this->cro_options['hpbwc_date'].$this->cro_options['hpbwc_time'];
                    if(  strtotime($date) >= current_time( 'timestamp' )){
                        _e( '<div class="simply-countdown cro-countdown"></div>', "cro-booster" );

                        wp_enqueue_script($this->plugin_name . '-countdown');
                        wp_enqueue_script($this->plugin_name);
                    }
                }

                if( !empty( $this->cro_options['hpbwc_sale_tag'] ) ) {
                    echo sprintf('<div class="hpbwc-sale-tag">%s</div>', esc_html__($this->cro_options['hpbwc_sale_tag']));
                }
  
                if( !empty( $this->cro_options['hpbwc_link_message'] ) && !empty( $this->cro_options['hpbwc_link_message'] ) ) {
                    echo sprintf('<div class="hpbwc-link-message">%s</div>', wp_kses_post($this->cro_options['hpbwc_link_message']));
                }
                
                ?>                
            </div>
        </div>
        <?php

    }

    /**
     * Adding code for the Header Promotional Bar With Countdown side of the site.
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
            .cro-booster-hpbwc{
                text-align:center;
                font-size: 17px;
                padding: 0;
                color: <?php _e($this->cro_options['hpbwc_text_color'], "cro-booster");?>;
                background-color: <?php _e($this->cro_options['hpbwc_bg_color'], "cro-booster");?>
            }
            .cro-booster-hpbwc .cro-inside{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .cro-booster-hpbwc .hpbwc-message{
                font-weight: bold;
                margin: 0 5px;
                font-size: 130%;
            }
            .cro-booster-hpbwc .cro-countdown{
                display: inline-flex;
                font-size: 120%;
                font-weight: bold;
                margin: 0px 5px;
            }
            .cro-booster-hpbwc .cro-countdown .simply-section{
                margin: 2px 1px;
                background: red;
                color: #fff;
                padding: 2px 15px 6px 15px;
            }
            .cro-booster-hpbwc .cro-countdown .simply-section > div{
                display: flex;
                flex-direction: column;
                line-height: initial;
            }
            .cro-booster-hpbwc .cro-countdown .simply-amount{
                font-weight: bold;
            }
            .cro-booster-hpbwc .cro-countdown .simply-word{
                font-size: 50%;
                line-height: 9px;
            }          
            .cro-booster-hpbwc .hpbwc-sale-tag{
                margin: 5px;
                text-decoration: none;
                padding: 4px 15px;
                display: inline-block;
                border-radius: 3px;
                font-weight: bold;
                font-size: 130%;

                background-color: <?php _e($this->cro_options['hpbwc_sale_tag_bg_color'], "cro-booster");?>;
                border: 1px dashed #fff;
                border-color: <?php _e($this->cro_options['hpbwc_sale_tag_border_color'], "cro-booster");?>;

            }
            .cro-booster-hpbwc .hpbwc-link-message{
                margin: 0px 5px;
                font-size: 130%;
            }
            .cro-booster-hpbwc .hpbwc-link-message a{
                color: <?php _e($this->cro_options['hpbwc_link_message_color'], "cro-booster");?>;
            }
        <?php

    }


}


new Cro_Booster_Header_Promotional_Bar_With_Countdown( Cro_Booster::get_plugin_name(), Cro_Booster::get_version(), Cro_Booster::get_cro_options() );