<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://author.example.com/
 * @since             1.0.0
 * @package           Restropress_Menu_Cart
 *
 * @wordpress-plugin
 * Plugin Name:       Restropress menu cart
 * Plugin URI:        https://https://example.com/plugins/the-basics/
 * Description:       Create a menu cart in Restropress
 * Version:           1.0.0
 * Author:            Bikash Sahoo
 * Author URI:        https://https://author.example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       restropress-menu-cart
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !defined( 'RP_MENU_CART_FILE' ) ) {

	define( 'RP_MENU_CART_FILE', __FILE__ );
}
 
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RESTROPRESS_MENU_CART_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-restropress-menu-cart-activator.php
 */
function activate_restropress_menu_cart() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-restropress-menu-cart-activator.php';
	Restropress_Menu_Cart_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-restropress-menu-cart-deactivator.php
 */
function deactivate_restropress_menu_cart() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-restropress-menu-cart-deactivator.php';
	Restropress_Menu_Cart_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_restropress_menu_cart' );
register_deactivation_hook( __FILE__, 'deactivate_restropress_menu_cart' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-restropress-menu-cart.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_restropress_menu_cart() {

	$plugin = new Restropress_Menu_Cart();
	$plugin->run();

}
run_restropress_menu_cart();