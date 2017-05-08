<?php

/**
 * Prevent Direct Access
 *
 * @since 0.1
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Register text domain
 *
 * @since 3.2
 */
function specificfeedsicon_textdomain() {
    load_plugin_textdomain( RFIFS_TEXT, false, RFIFS_DIR . '/languages/' );
}
add_action( 'init', 'specificfeedsicon_textdomain' );

/**
 * Print direct link to plugin admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the plugin admin page
 *
 * @since  3.2
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function specificfeedsicon_settings_link( $links ) {
    $page = '<a href="' . admin_url( 'options-general.php?page=rss-feed-icon-for-specificfeedscom.php' ) .'">' . __( 'Settings', RFIFS_TEXT ) . '</a>';
    array_unshift( $links, $page );
    return $links;
}
add_filter( 'plugin_action_links_'.RFIFS_BASE, 'specificfeedsicon_settings_link' );

/**
 * Print additional links to plugin meta row
 *
 * @since 4.0
 */
function specificfeedsicon_plugin_row_meta( $links, $file ) {

    if ( strpos( $file, 'specificfeeds-icon.php' ) !== false ) {

        $new_links = array(
                           'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8A88KC7TFF6CS" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', RFIFS_TEXT ) . '</a>'
                           );
        $links = array_merge( $links, $new_links );
    }

    return $links;
}
add_filter( 'plugin_row_meta', 'specificfeedsicon_plugin_row_meta', 10, 2 );

/**
 * Register plugin's submenu in the "Settings" Admin Menu
 *
 * @since 2.0
 */
function specificfeedsicon_register_submenu_page() {
    add_options_page( 'SpecificFeeds', 'SpecificFeeds', 'manage_options', 'rss-feed-icon-for-specificfeedscom', 'specificfeedsicon_render_submenu_page' );
}
add_action( 'admin_menu', 'specificfeedsicon_register_submenu_page' );

/**
 * Register settings
 *
 * @since 4.0
 */
function specificfeedsicon_register_settings() {
    register_setting( 'specificfeedsicon_settings_group', 'RssFeedIconSF_settings' );
    register_setting( 'specificfeedsicon_settings_group', 'RssFeedIconSF_service_info' );
}
add_action( 'admin_init', 'specificfeedsicon_register_settings' );
