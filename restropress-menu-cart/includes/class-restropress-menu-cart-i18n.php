<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://author.example.com/
 * @since      1.0.0
 *
 * @package    Restropress_Menu_Cart
 * @subpackage Restropress_Menu_Cart/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Restropress_Menu_Cart
 * @subpackage Restropress_Menu_Cart/includes
 * @author     Bikash Sahoo <bikashsahoobiki1999@gmail.com>
 */
class Restropress_Menu_Cart_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'restropress-menu-cart',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
