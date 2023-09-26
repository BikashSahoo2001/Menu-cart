<?php

class Restropress_Menu_Cart_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		
		$this->define_constants();
		$this->actions = array();
		$this->filters = array();
		add_action('admin_notices',array( $this, 'menu_cart_deactivation') );
		add_filter( 'plugin_action_links_' .RP_MENU_CART, array( $this, 'menu_cart_settings_link') );

	}

	private function define( $name, $value) {
		
		if( !defined( $name) ) {

			define( $name, $value);
		}
	}
     
	private function define_constants() {
		$this->define( 'RP_MENU_CART',plugin_basename( RP_MENU_CART_FILE) );
	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
		
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}
	public function menu_cart_deactivation() {
		 
		if ( ! is_plugin_active( 'restropress/restro-press.php' ) ) {
			$plugin_link = 'https://wordpress.org/plugins/restropress/';
			/* translators: %1$s: plugin link for restropress */
			echo '<div id="notice" class="error"><p>' . sprintf( __( ' Restropress menu cart <a href="%1$s" target="_blank"> RestroPress </a> plugin to be installed. Please install and activate it', 'rp-menu-cart' ), esc_url( $plugin_link ) ).  '</p></div>';
			deactivate_plugins( '/restropress-menu-cart/restropress-menu-cart.php' );
		}
	}

	public function menu_cart_settings_link(  $links ) {

		$link = admin_url( 'admin.php?page=rpress-settings&tab=general&section=menu' );

		$settings_link = sprintf( __( '<a href="%1$s">Settings</a>', 'rp-menu-cart' ), esc_url( $link ) );
        array_unshift( $links, $settings_link );

        return $links;
         
	}

}
