<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://author.example.com/
 * @since      1.0.0
 *
 * @package    Restropress_Menu_Cart
 * @subpackage Restropress_Menu_Cart/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Restropress_Menu_Cart
 * @subpackage Restropress_Menu_Cart/public
 * @author     Bikash Sahoo <bikashsahoobiki1999@gmail.com>
 */
class Restropress_Menu_Cart_Public {

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
		//add_action( 'rpress_before_service_time', 'add_content_to_front_page' );
		add_filter( 'wp_nav_menu_items' , array( $this, 'add_menu_cart' ) , 10, 2);  
		add_action('wp_ajax_nopriv_get_cart_details',[$this,"get_cart_details"]);
		add_action('wp_ajax_get_cart_details',[$this,"get_cart_details"]);
	}

	public function get_cart_details() {
		$subtotal = rpress_get_cart_subtotal();
		$cart_details = count(rpress_get_cart_content_details());
		$data = get_option( 'rpress_settings' );
		$menu_items_option = $data['display_menu']; 
		$response = array(
			'subtotal' => $subtotal,
			'cart_details' => $cart_details,
			'menu_items_option' => $menu_items_option
			
		);
		wp_send_json($response);

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
		 * defined in Restropress_Menu_Cart_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Restropress_Menu_Cart_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/restropress-menu-cart-public.css', array(), $this->version, 'all' );

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
		 * defined in Restropress_Menu_Cart_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Restropress_Menu_Cart_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/restropress-menu-cart-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	}
     
	public function add_menu_cart($items, $args) {
		$items  .= '<li class="menu-item menu_cart_heading">'  
				. '<label>' 
				. '<span id="cart-details"></span>'
				. '</label>'
				. '</li>';
		
	  return $items;
    }

}