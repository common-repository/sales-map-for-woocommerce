<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://sevengits.com/
 * @since      1.0.0
 *
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/public
 * @author     Sevengits <support@sevengits.com>
 */
class Sales_Map_Woo_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/sales-map-woo-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		global $post;
		if (has_shortcode($post->post_content, 'sgitswcsm')) {
			wp_enqueue_script('sgitswcsm-googlemapcluster', "https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js", array('jquery'), $this->version, false);
			$api_key = get_option('sgitswcsm_gmap_api', '');
			wp_enqueue_script('sgitswcsm-googlemap', "//maps.googleapis.com/maps/api/js?key=$api_key", array('jquery'), $this->version, false);
			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/sales-map-woo-public.js', array('jquery', 'sgitswcsm-googlemap', 'sgitswcsm-googlemapcluster'), $this->version, false);
		}
	}

	public function sgitswcsm_new_order_address_latlng($order_id)
	{
		$order = wc_get_order($order_id);
		$address = $order->get_billing_address_1() . ', ' . $order->get_billing_address_2() . ', ' . $order->get_billing_city() . ', ' . $order->get_billing_state() . ', ' . $order->get_billing_postcode() . ', ' . $order->get_billing_country();

		$api_key = get_option('sgitswcsm_gmap_api', '');
		$google_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($address) . '&key=' . $api_key;
		$response = wp_remote_post($google_url);
		if (!is_wp_error($response)) {
			$responceData = json_decode(wp_remote_retrieve_body($response), true);
			$latlng = $responceData['results'][0]['geometry']['location'];
			wc_add_order_item_meta($order_id, 'sgitswcsm_latlng', $latlng);
		} else {
			if (get_option('sgitswcsm_debug_mode', 'no') === 'yes') {
				echo 'Response:<pre>';
				print_r($response);
				echo '</pre>';
			}
		}
	}

	public function sgitswcsm_display_init($atts)
	{
		$args = array(
			'limit' => get_option('sgitswcsm_order_count', 10),
			'order' => 'DESC',
			'orderby' => 'id',
			'return' => 'ids',
			// 'status' => ['completed']
		);
		$orders = wc_get_orders($args);
		$locations = array();
		foreach ($orders as $orderid) {
			$meta = wc_get_order_item_meta($orderid, 'sgitswcsm_latlng');
			if ($meta) {
				array_push($locations, $meta);
			}
		}
		$default_latlng = explode(",", get_option('sgitswcsm_default_latlong', '41.7091413, -87.7945715'));
		$default_latlng = array(array('lat' => floatval($default_latlng[0]), 'lng' => floatval($default_latlng[1])));
?>
		<div class="sgits-hidden-list">
			<input type="hidden" id="sgitswcsm_zoom_level" value="<?php echo get_option('sgitswcsm_default_zoom', '13'); ?>">
			<textarea style="display: none;" id="sgitswcsm_latlng"><?php echo json_encode($default_latlng); ?></textarea>
			<textarea style="display: none;" id="sgitswcsm_locations"><?php echo json_encode($locations); ?></textarea>
			<input type="hidden" id="sgitswcsm_debug_mode" value="<?php echo get_option('sgitswcsm_debug_mode', 'yes'); ?>">
		</div>
		<div class="sgitswcs_map" id="sgitswcs_map"></div>

<?php

	}
}
