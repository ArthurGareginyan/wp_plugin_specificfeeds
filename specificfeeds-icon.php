<?php
/**
 * Plugin Name: RSS Feed Icon for SpecificFeeds.com
 * Plugin URI: https://github.com/ArthurGareginyan/rss-feed-icon-for-specificfeedscom
 * Description: This plugin allows you to easily add RSS feed icon by SpecificFeeds.com in any place on your website.
 * Author: Arthur Gareginyan
 * Author URI: http://www.arthurgareginyan.com
 * Version: 2.0.1
 * License: GPL3
 * Text Domain: rss-feed-icon-for-specificfeedscom
 * Domain Path: /languages/
 *
 * Copyright 2014-2016 Arthur Gareginyan (email : arthurgareginyan@gmail.com)
 *
 * This file is part of "RSS Feed Icon for SpecificFeeds.com".
 *
 * "RSS Feed Icon for SpecificFeeds.com" is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * "RSS Feed Icon for SpecificFeeds.com" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with "RSS Feed Icon for SpecificFeeds.com".  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Prevent Direct Access
 *
 * @since 0.1
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Define constants
 *
 * @since 2.0
 */
defined('RFIFS_DIR') or define('RFIFS_DIR', dirname(plugin_basename(__FILE__)));
defined('RFIFS_BASE') or define('RFIFS_BASE', plugin_basename(__FILE__));
defined('RFIFS_URL') or define('RFIFS_URL', plugin_dir_url(__FILE__));
defined('RFIFS_PATH') or define('RFIFS_PATH', plugin_dir_path(__FILE__));

/**
 * Register text domain
 *
 * @since 2.0
 */
function specificfeedsicon_textdomain() {
	load_plugin_textdomain( 'rss-feed-icon-for-specificfeedscom', false, RFIFS_DIR . '/languages/' );
}
add_action( 'init', 'specificfeedsicon_textdomain' );

/**
 * Print direct link to SpecificFeeds admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the SpecificFeeds admin page
 *
 * @since  2.0
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function specificfeedsicon_settings_link( $links ) {
	$settings_page = '<a href="' . admin_url( 'options-general.php?page=rss-feed-icon-for-specificfeedscom.php' ) .'">' . __( 'Settings', 'rss-feed-icon-for-specificfeedscom' ) . '</a>';
	array_unshift( $links, $settings_page );
	return $links;
}
add_filter( "plugin_action_links_".RFIFS_BASE, 'specificfeedsicon_settings_link' );

/**
 * Register "SpecificFeeds" submenu in "Settings" Admin Menu
 *
 * @since 2.0
 */
function specificfeedsicon_menu() {
	add_options_page('SpecificFeeds', 'SpecificFeeds', 'manage_options', 'rss-feed-icon-for-specificfeedscom', 'specificfeedsicon_render_submenu_page');
}
add_action('admin_menu', 'specificfeedsicon_menu');

/**
 * Attach Settings Page
 *
 * @since 2.0
 */
require_once( RFIFS_PATH . 'inc/settings_page.php' );

/**
 * Load scripts and style sheet for settings page
 *
 * @since 2.0
 */
function specificfeedsicon_load_scripts($hook) {

    // Return if the page is not a settings page of this plugin
    if ( 'settings_page_rss-feed-icon-for-specificfeedscom' != $hook ) {
        return;
    }

    // Style sheet
    wp_enqueue_style('styles', RFIFS_URL . 'inc/style.css');
}
add_action( 'admin_enqueue_scripts', 'specificfeedsicon_load_scripts' );

/**
 * Register settings
 *
 * @since 0.1
 */
function specificfeedsicon_register_settings() {
	register_setting( 'specificfeedsicon_settings_group', 'specificfeedsicon_link' );
	register_setting( 'specificfeedsicon_settings_group', 'specificfeedsicon_icon' );
}
add_action( 'admin_init', 'specificfeedsicon_register_settings' );

/**
 * ShortCode SpecificFeeds
 *
 * @since 2.0
 */
function specificfeedsicon_shortcode() {

    // Set variables
    $sf_link = get_option( 'specificfeedsicon_link' );
    $sf_icon = get_option( 'specificfeedsicon_icon' );
    $sf_icon_src = plugins_url( 'inc/images/icons/' . $sf_icon . '_one.png', __FILE__ );

	// Generating output code
	return '<a
				href="'.$sf_link.'"
				target="_blank"
				rel="nofollow"
    		>
    		<img
    			src="'.$sf_icon_src.'"
    			width="48"
    			height="48"
    			style="border: none;"
    		/>
    		</a>';
}
add_shortcode('specificfeeds-icon', 'specificfeedsicon_shortcode');

/**
 * Allow shortcodes in the text widget
 *
 * @since 1.5
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Delete Options on Uninstall
 *
 * @since 0.1
 */
function specificfeedsicon_uninstall() {
	delete_option( 'specificfeedsicon_link' );
	delete_option( 'specificfeedsicon_icon' );
}
register_uninstall_hook( __FILE__, 'specificfeedsicon_uninstall' );

?>