<?php

/**
 * Provide a admin area settings for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://sevengits.com/
 * @since      1.0.0
 *
 * @package    Sales_Map_Woo
 * @subpackage Sales_Map_Woo/admin/partials
 */

$custom_settings =  array(

    array(
        'name' => esc_html__('Sg Sales map for Woocommerce', 'sales-map-for-woocommerce'),
        'type' => 'title',
        'desc'  => 'Use shortcode [sgitswcsm] for displaying map in page/post etc..',
        'id'   => 'sgitswcsm_main'
    ),

    array(
        'name' => esc_html__('Level of details', 'sales-map-for-woocommerce'),
        'type' => 'select',
        'id' => 'sgitswcsm_detail_level',
        'options' => array(
            'sgitswcsm_city' => esc_attr__('City', 'sales-map-for-woocommerce'),
            'sgitswcsm_state' => esc_attr__('State', 'sales-map-for-woocommerce'),
            'sgitswcsm_country' => esc_attr__('Country', 'sales-map-for-woocommerce'),
        ),
    ),

    array(
        'name' => esc_html__('Show sales count', 'sales-map-for-woocommerce'),
        'id' => 'sgitswcsm_sale_count',
        'type' => 'checkbox',
    ),
    array(
        'name' => esc_html__('No. of orders', 'sales-map-for-woocommerce'),
        'id' => 'sgitswcsm_order_count',
        'type' => 'number',
        'default' => 10
    ),

    // map settings

    array(
        'name' => 'Google map api',
        'id' => 'sgitswcsm_gmap_api',
        'type' => 'text',
        'required' => true
    ),

    array(
        'name' => 'Map Default latlong',
        'id' => 'sgitswcsm_default_latlong',
        'type' => 'text',
        'default' => "41.7091413, -87.7945715",
        'desc_tip' => false,
        'desc' => esc_html__('Enter latitude and longitude comma seperated.', 'sales-map-for-woocommerce'),

    ),

    array(
        'name' => 'Map Zoom level',
        'id' => 'sgitswcsm_default_zoom',
        'type' => 'number',
        'default' => 13
    ),

    array(
        'name' => 'Debugging mode',
        'id' => 'sgitswcsm_debug_mode',
        'default' => 'no',
        'type' => 'checkbox',
    ),

    array(
        'name' => esc_html__('Additional CSS', 'sales-map-for-woocommerce'),
        'type' => 'textarea',
        'id' => 'sgitswcsm_custom_styles',
        'placeholder' => esc_attr__('Custom styles enter here...', 'sales-map-for-woocommerce'),
        'custom_attributes' => array('rows' => 10),
    ),

    array(
        'name' => esc_html__('Licence Key', 'sales-map-for-woocommerce'),
        'type' => 'text',
        'id'    => 'sgitswcsm_license_key',
        'desc' => esc_html__('Enter valid license key for getting automatic updates.', 'sales-map-for-woocommerce'),
        'desc_tip' => false,

    ),

    array(
        'type' => 'sectionend',
        'name' => 'end_section',
        'id' => 'ppw_woo'
    ),
);
