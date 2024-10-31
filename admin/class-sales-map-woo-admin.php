<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://sevengits.com/
 * @since      1.0.0
 *
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/admin
 * @author     Sevengits <support@sevengits.com>
 */
class Sales_Map_Woo_Admin
{

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sales_Map_Woo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sales_Map_Woo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/sales-map-woo-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sales_Map_Woo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sales_Map_Woo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/sales-map-woo-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * @since 1.0.0 
	 */
	public function sgitswcsm_settings($settings, $current_section)
	{
		$custom_settings = array();

		if ('sgitswcsm_settings_tab' == $current_section) {

			require plugin_dir_path(__FILE__ ). '/partials/sales-map-woo-admin-settings.php';
			return $custom_settings;
		} else {

			return $settings;
		}
	}

	/**
	 * @since 1.0.0 
	 */
	public function sgitswcsm_settings_tab($settings_tab)
	{

		$settings_tab['sgitswcsm_settings_tab'] = esc_html('SG Woo Sales Map');
		return $settings_tab;
	}

	/**
	 * @since 1.0.0 
	 */
	public function sgitswcsm_settings_link($links)
	{
		
		$links[] = sprintf('<a href="%s">%s</a>', esc_url(admin_url('admin.php?page=wc-settings&tab=advanced&section=sgitswcsm_settings_tab')), esc_html__('Settings', 'sg-checkout-location-picker'));
		
		return $links;
	}
	
	/**
	 * @since 1.0.0 
	 */
	function sgitswcsm_plugin_row_meta( $links, $file ) {    
		if ( strpos( $file, 'sales-map-woo.php' ) !== false ) {
			require plugin_dir_path( __FILE__ ) . 'partials/sales-map-woo-row-meta-additional-links.php';
			
			$links = array_merge( $links, $new_links );
		}
		
		return $links;
	}

}
