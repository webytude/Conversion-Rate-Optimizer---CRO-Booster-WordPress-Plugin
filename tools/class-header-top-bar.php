<?php

/**
 * Top Header Top Bar functionality of the plugin.
 *
 * @link       http://webytude.com/
 * @since      1.0.0
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */

/**
 * The Header Top Bar functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the Header Top Bar stylesheet and JavaScript.
 *
 * @package    Cro_Booster
 * @subpackage Cro_Booster/tools
 */
class Cro_Booster_Header_Top_Bar {

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

		add_action('cro_options_fields', array($this, 'header_top_bar_fields'));

		if( isset( $this->cro_options['htb_switcher'] ) && $this->cro_options['htb_switcher'] == "yes"){
			if( !empty( $this->cro_options['htb_bg_color'] ) && !empty( $this->cro_options['htb_text_color'] ) ){

				add_action('wp_body_open', array($this, 'header_top_bar_view'));
				add_action('cro_styles', array($this, 'cro_styles'));

			}
		}
	} 
	 
	/**
	 * Register the new field for the Header Top Bar side of the site.
	 *
	 * @since    1.0.0
	 */
	public function header_top_bar_fields( $fields ) {

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
            'name'   => 'header-top-bar',
            'title'  => __('Header Top Bar', "cro-booster"),
            'fields' => array(

            	array(
                    'id'      => 'htb_switcher',
                    'type'    => 'switcher',
                    'title'   => __('Enable/Disable', "cro-booster"),
                    'label'   => __('Enable this option to display Header Top Bar', "cro-booster"),
                ),

            	array(
                    'id'     => 'htb_bg_color',
                    'type'   => 'color_wp',
                    'title'  => __('Background Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#000000',

                ),

                array(
                    'id'     => 'htb_text_color',
                    'type'   => 'color_wp',
                    'title'  => __('Text Color', "cro-booster"),
                    'rgba'   => true,
                    'default'=> '#ffffff',
                ),

                array(
                    'type'    => 'fieldset',
                    'id'      => 'htb_left_side',
                    'title'   => __('Left Side', "cro-booster"),
                    'fields'  => array(

                        array(
		                    'id'          => 'phone',
		                    'type'        => 'text',
		                    'title'       => __('Phone Number', "cro-booster"),
		                    'class'       => 'text-class',
		                    'attributes'    => array(
		                       'placeholder' => '+1 (xxx) xxx-xx-xx'

		                    ),
		                    'sanitize'    => array( $this, 'test_sanitize_callback' ),

		                ), 

		                array(
		                    'id'          => 'email',
		                    'type'        => 'text',
		                    'title'       => __('Email', "cro-booster"),
		                    'class'       => 'text-class',
		                    'attributes'    => array(
		                       'placeholder' => 'example@domain.com'

		                    ),
		                    'sanitize'    => array( $this, 'email_sanitize_callback' ),

		                ), 
 
                    ),
                ),

                array(
                    'type'    => 'fieldset',
                    'id'      => 'htb_right_side',
                    'title'   => __('Right Side', "cro-booster"),
                    'fields'  => array(
                    	array(
                    		'id'          => 'htb_description',
		                    'type'        => 'editor',
		                    'title'       => __('Description', "cro-booster"),
		                    'class'       => 'text-class',
		                    'description' => 'You can add you address',
		                ), 
                    ),
                ),

                array(
                    'id'     => 'htb_link_color',
                    'type'   => 'color_wp',
                    'title'  => __('Link Color', "cro-booster"),
                    'rgba'   => true,
                ),

                array(
                    'id'     => 'htb_link_hover_color',
                    'type'   => 'color_wp',
                    'title'  => __('Link Hover Color', "cro-booster"),
                    'rgba'   => true,
                ),
            ),
        );
        
        return $fields;

	}

	/**
	 * Adding code for the Header Top Bar side of the site.
	 *
	 * @since    1.0.0
	 */
	public function header_top_bar_view() {

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
		if( (
			!empty( $this->cro_options['htb_left_side']['phone'] ) &&
			!empty( $this->cro_options['htb_left_side']['email'] ) 
			) ||
			!empty( $this->cro_options['htb_right_side']['htb_description'] )
		){
			?>
			<div class="cro-booster-htb">
				<?php
				if (!empty( $this->cro_options['htb_left_side']['phone'] ) &&
					!empty( $this->cro_options['htb_left_side']['email'] ) 
				)
				{
					?>
						<div class="cro-left">
							<ul>
								<?php
								if( !empty( $this->cro_options['htb_left_side']['phone'] ) ){
									echo sprintf('<li><a href="tel:%s">%s</a></li>', preg_replace('/\D/', '', esc_html__($this->cro_options['htb_left_side']['phone'])), esc_html__($this->cro_options['htb_left_side']['phone']) );
								}
								if( !empty( $this->cro_options['htb_left_side']['email'] ) ){
									echo sprintf('<li><a href="mailto:%s">%s</a></li>',  sanitize_email($this->cro_options['htb_left_side']['email']), sanitize_email($this->cro_options['htb_left_side']['email']) );
								}
								?>
								
							</ul>
						</div>
					<?php
				}
				if( !empty( $this->cro_options['htb_right_side']['htb_description'] ) ){
					?>
						<div class="cro-right"><?php echo wp_kses_post( $this->cro_options['htb_right_side']['htb_description'], "cro-booster" );?></div>
					<?php
				}
				?>
			</div>
			<?php
		}

	}

	/**
	 * Adding code for the Header Top Bar side of the site.
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
			.cro-booster-htb{
				font-size: 17px;
				padding: 5px 5px;
			    display: flex;
			    justify-content: space-between;
    			align-items: center;
			    background-color: <?php _e($this->cro_options['htb_bg_color'], "cro-booster");?>;
			    color: <?php _e($this->cro_options['htb_text_color'], "cro-booster");?>;
			}
			.cro-booster-htb ul{
				list-style:none;
				padding: 0;
			}
			.cro-booster-htb ul li{
				display: inline-block;
				margin-right: 10px;
			}
			.cro-booster-htb a{
			    color: <?php _e($this->cro_options['htb_link_color'], "cro-booster");?>;
			}
			.cro-booster-htb a:hover,
			.cro-booster-htb a:focus{
			    color: <?php _e($this->cro_options['htb_link_hover_color'], "cro-booster");?>;
			}

			@media only screen and (max-width: 767px) {
				.cro-booster-htb{
					flex-direction: column;
				}
			}
		<?php

	}



}


new Cro_Booster_Header_Top_Bar( Cro_Booster::get_plugin_name(), Cro_Booster::get_version(), Cro_Booster::get_cro_options() );