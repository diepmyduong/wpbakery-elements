<?php
/*
Plugin Name: Partner Logos
Description: A custom element for displaying a list of partner company logos in WPBakery Page Builder.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define the custom content element for WPBakery Page Builder
add_action( 'vc_before_init', 'partner_logos_integrateWithVC' );
function partner_logos_integrateWithVC() {
    vc_map( array(
        'name' => __( 'Partner Logos', 'text-domain' ),
        'base' => 'partner_logos',
        'category' => __( 'Content', 'text-domain' ),
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => __( 'Images', 'text-domain' ),
                'param_name' => 'images',
                'value' => '',
                'description' => __( 'Select the images you want to display.', 'text-domain' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image size', 'text-domain' ),
                'param_name' => 'size',
                'value' => '',
                'description' => __( 'Enter the size of the images in pixels (e.g. "100").', 'text-domain' ),
            ),
        ),
    ) );
}

// Define the shortcode for the custom element
function partner_logos_shortcode($atts) {
    $atts = shortcode_atts( array(
        'images' => '',
        'size' => '',
    ), $atts );

    $images = explode(',', $atts['images']);
    $size = $atts['size'];

    $output = '<div class="partner-logos">';

    foreach ($images as $image) {
        $output .= '<img src="' . wp_get_attachment_url($image) . '" alt="" class="partner-logo" style="width:' . $size . 'px;height:auto;">';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('partner_logos', 'partner_logos_shortcode');

// Enqueue the plugin stylesheet
function partner_logos_enqueue_styles() {
    wp_enqueue_style( 'partner-logos', plugin_dir_url( __FILE__ ) . 'style.css' );
}
add_action( 'wp_enqueue_scripts', 'partner_logos_enqueue_styles' );
