<?php

/**
 * Prevent Direct Access
 */
defined( 'ABSPATH' ) or die( "Restricted access!" );

/**
 * Base for the _load_scripts hook
 */
function spacexchimp_p002_load_scripts_base( $options ) {

    // Put value of constants to variables for easier access
    $slug = SPACEXCHIMP_P002_SLUG;
    $prefix = SPACEXCHIMP_P002_PREFIX;
    $url = SPACEXCHIMP_P002_URL;

    // Load jQuery library
    wp_enqueue_script( 'jquery' );

    // Style sheet
    wp_enqueue_style( $prefix . '-frontend-css', $url . 'inc/css/frontend.css' );

    // JavaScript
    wp_enqueue_script( $prefix . '-frontend-js', $url . 'inc/js/frontend.js' );

    // Dynamic CSS. Create CSS and injected it into the stylesheet
    $icon_size = !empty( $options['icon_size'] ) ? $options['icon_size'] : '60';
    $custom_css = "
                    .RssFeedIconSF {

                    }
                    .RssFeedIconSF img {
                        width: " . $icon_size . "px !important;
                        height: " . $icon_size . "px !important;
                    }
                  ";
    wp_add_inline_style( $prefix . '-frontend-css', $custom_css );

}

/**
 * Load scripts and style sheet for settings page
 */
function spacexchimp_p002_load_scripts_admin( $hook ) {

    // Put value of constants to variables for easier access
    $slug = SPACEXCHIMP_P002_SLUG;
    $prefix = SPACEXCHIMP_P002_PREFIX;
    $url = SPACEXCHIMP_P002_URL;
    $settings = SPACEXCHIMP_P002_SETTINGS;

    // Return if the page is not a settings page of this plugin
    $settings_page = 'settings_page_' . $slug;
    if ( $settings_page != $hook ) {
        return;
    }

    // Read options from database
    $options = get_option( $settings . '_settings' );

    // Bootstrap library
    wp_enqueue_style( $prefix . '-bootstrap-css', $url . 'inc/lib/bootstrap/bootstrap.css' );
    wp_enqueue_style( $prefix . '-bootstrap-theme-css', $url . 'inc/lib/bootstrap/bootstrap-theme.css' );
    wp_enqueue_script( $prefix . '-bootstrap-js', $url . 'inc/lib/bootstrap/bootstrap.js' );

    // Font Awesome library
    wp_enqueue_style( $prefix . '-font-awesome-css', $url . 'inc/lib/font-awesome/css/font-awesome.css', 'screen' );

    // Other libraries
    wp_enqueue_script( $prefix . '-bootstrap-checkbox-js', $url . 'inc/lib/bootstrap-checkbox.js' );

    // Style sheet
    wp_enqueue_style( $prefix . '-admin-css', $url . 'inc/css/admin.css' );

    // JavaScript
    wp_enqueue_script( $prefix . '-admin-js', $url . 'inc/js/admin.js', array(), false, true );

    // Dynamic JS. Create JS object and injected it into the JS file
    $plugin_url = SPACEXCHIMP_P002_URL;
    $script_params = array(
                           'plugin_url' => $plugin_url
                           );
    wp_localize_script( $prefix . '-admin-js', $prefix . '_scriptParams', $script_params );

    // Call the function that contain a basis of scripts
    spacexchimp_p002_load_scripts_base( $options );

}
add_action( 'admin_enqueue_scripts', 'spacexchimp_p002_load_scripts_admin' );

/**
 * Load scripts and style sheet for front end of website
 */
function spacexchimp_p002_load_scripts_frontend() {

    // Put value of constants to variables for easier access
    $slug = SPACEXCHIMP_P002_SLUG;
    $prefix = SPACEXCHIMP_P002_PREFIX;
    $url = SPACEXCHIMP_P002_URL;
    $settings = SPACEXCHIMP_P002_SETTINGS;

    // Read options from database
    $options = get_option( $settings . '_settings' );

    // Call the function that contain a basis of scripts
    spacexchimp_p002_load_scripts_base( $options );

    // Other libraries
    wp_enqueue_style( $prefix . '-bootstrap-tooltip-css', $url . 'inc/lib/bootstrap-tooltip/bootstrap-tooltip.css' );
    wp_enqueue_script( $prefix . '-bootstrap-tooltip-js', $url . 'inc/lib/bootstrap-tooltip/bootstrap-tooltip.js' );

}
add_action( 'wp_enqueue_scripts', 'spacexchimp_p002_load_scripts_frontend' );
