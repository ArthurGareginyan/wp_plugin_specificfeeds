<?php

/**
 * Prevent Direct Access
 */
defined( 'ABSPATH' ) or die( "Restricted access!" );

/**
 * Delete options on uninstall
 */
function spacexchimp_p002_uninstall() {
    delete_option( SPACEXCHIMP_P002_SETTINGS . '_settings' );
}
register_uninstall_hook( __FILE__, 'spacexchimp_p002_uninstall' );
