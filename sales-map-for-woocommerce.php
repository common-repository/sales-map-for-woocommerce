<?php

/**
  * @link              http://sevengits.com/
 * @since             1.0.0
 * @package           Sales_Map_Woo
 *
 * @wordpress-plugin
 * Plugin Name:       Sales Map for Woocommerce
 * Plugin URI:        http://sevengits.com/sales-map-for-woocommerce
 * Description:      Sales Map for WooCommerce is a plugin that shows sales in a google map with shortcode , [sgitswcsm].
 * Version:           1.0.0
 * Author:            Sevengits
 * Author URI:        http://sevengits.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sales-map-for-woocommerce
 * Domain Path:       /languages
 * WC requires at least: 3.7
 * WC tested up to: 5.3
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
if (!defined('SGMW_VERSION')) {
    define('SGMW_VERSION', '1.0.0');
}
if (!defined('SGMW_SALES_MAP_WOO')) {
    define('SGMW_SALES_MAP_WOO', plugin_basename(__FILE__));
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sales-map-woo-activator.php
 */
function activate_sales_map_woo()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-sales-map-woo-activator.php';
    Sales_Map_Woo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sales-map-woo-deactivator.php
 */
function deactivate_sales_map_woo()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-sales-map-woo-deactivator.php';
    Sales_Map_Woo_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_sales_map_woo');
register_deactivation_hook(__FILE__, 'deactivate_sales_map_woo');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-sales-map-woo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sales_map_woo()
{

    $plugin = new Sales_Map_Woo();
    $plugin->run();
}
run_sales_map_woo();
