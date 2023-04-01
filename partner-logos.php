<?php

// Define custom element
function custom_partner_logos() {
  vc_map(
    array(
      "name" => "Partner Logos",
      "base" => "partner_logos",
      "category" => "Content",
      "params" => array(
        array(
          "type" => "attach_images",
          "heading" => "Logos",
          "param_name" => "logos",
          "description" => "Select the logos of your partner companies."
        ),
        array(
          "type" => "textfield",
          "heading" => "Logo width",
          "param_name" => "logo_width",
          "description" => "Enter the width of each logo in pixels."
        )
      )
    )
  );
}

add_action( 'vc_before_init', 'custom_partner_logos' );

// Define shortcode
function custom_partner_logos_shortcode( $atts ) {
  extract( shortcode_atts(
    array(
      'logos' => '',
      'logo_width' => '100'
    ),
    $atts
  ));

  

  $output = '<div class="partner-logos">';
  
  // Get array of image ids
  $logos_array = explode(',', $logos);
  
  // Loop through images and add to output
  foreach ($logos_array as $logo) {
    $logo_src = wp_get_attachment_image_src($logo, 'full');
    
    $output .= '<div class="partner-logo" style="width:'.$logo_width.'px"><img src="'.$logo_src[0].'" alt=""></div>';
  }
  
  $output .= '</div>';

  return $output;
}

add_shortcode( 'partner_logos', 'custom_partner_logos_shortcode' );

?>
