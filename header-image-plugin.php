<?php
/*
Plugin Name: Header Image Plugin
Plugin URI: https://bakry.com/
Description: Allows you to change the header image.
Version: 1.0
Author: bakry
Author URI: https://bakry.com/
License: GPL2
*/

// Add a customizer section for the header image
function header_image_customizer_section( $wp_customize ) {
    $wp_customize->add_section( 'header_image_section', array(
        'title' => __( 'Header Image', 'header-image-plugin' ),
        'priority' => 30,
    ) );

    // Add a setting for the header image
    $wp_customize->add_setting( 'header_image_setting', array(
        'default' => '',
        'transport' => 'refresh',
    ) );

    // Add a control for the header image
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_image_control', array(
        'label' => __( 'Header Image', 'header-image-plugin' ),
        'section' => 'header_image_section',
        'settings' => 'header_image_setting',
    ) ) );
}
add_action( 'customize_register', 'header_image_customizer_section' );

// Add the header image to the header
function custom_header_image() {
    $header_image = get_theme_mod( 'header_image_setting' );
    if ( $header_image ) {
        $version = time(); // Add a version number to the image URL
        echo '<div class="site-logo">';
        echo '<a href="' . home_url() . '"><img id="header_image" class="site-logo" src="' . esc_url( $header_image ) . '?v=' . $version . '" alt="Site Logo"></a>';
        echo '</div>';
    }
}
add_action( 'affsquare_header', 'custom_header_image' );