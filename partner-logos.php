<?php
/*
Plugin Name: Partner Logos
Description: A custom element for displaying a list of partner company logos.
Version: 1.0
Author: Your Name
*/

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
        $output .= '<img src="' . $image . '" alt="" class="partner-logo" style="width:' . $size . 'px;height:auto;">';
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
