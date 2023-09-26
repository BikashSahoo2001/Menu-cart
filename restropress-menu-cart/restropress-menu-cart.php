<?php

/**
 * Plugin Name:       Restropress menu cart
 * Description:       This plugin helps you to add a Cart Menu on your header.
 * Version:           1.0.0
 * Author:            Magnigenie
 * Author URI:        https://restropress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rp-menu-cart
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
