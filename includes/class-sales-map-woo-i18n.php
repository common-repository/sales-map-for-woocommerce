<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://sevengits.com/
 * @since      1.0.0
 *
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/includes
 * @author     Sevengits <support@sevengits.com>
 */
class Sales_Map_Woo_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sales-map-woo',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
