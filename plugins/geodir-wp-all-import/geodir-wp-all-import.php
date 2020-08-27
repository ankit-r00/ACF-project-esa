<?php
/**
 * This is the main plugin file, here we declare and call the important stuff
 *
 * @package           Geodir_WP_All_Import
 * @copyright         2019 AyeCode Ltd
 * @license           GPLv3
 * @since             1.0.0
 *
 * Plugin Name: GeoDirectory WP All Import
 * Plugin URI: https://wpgeodirectory.com/downloads/wp-all-import/
 * Description: Import the csv using wp all import plugin and this add on.
 * Version: 2.0.0.0-beta
 * Author: AyeCode Ltd
 * Author URI: https://wpgeodirectory.com/
 * Requires at least: 4.9
 * Tested up to: 5.0.2
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: geodir-wpai
 * Domain Path: /languages
 * Update URL: https://wpgeodirectory.com
 * Update ID: 687375
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

// check user is_admin or not.
if( is_admin() ) {

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // check Geodirectory plugin activate.
    if ( !is_plugin_active( 'geodirectory/geodirectory.php' ) ) {

        deactivate_plugins( plugin_basename( __FILE__ ) );

        function gd_wpai_requires_gd_plugin() {
            echo '<div class="notice notice-warning is-dismissible"><p><strong>' . sprintf( __( '%s requires the %sGeoDirectory%s plugin to be installed and active.', 'geodir-wpai' ), 'GeoDirectory WP All Import', '<a href="https://wpgeodirectory.com" target="_blank" title=" GeoDirectory">', '</a>' ) . '</strong></p></div>';
        }

        add_action( 'admin_notices', 'gd_wpai_requires_gd_plugin' );
        return;

    }

    // check WP All Import plugin not activate.
    if ( !is_plugin_active( 'wp-all-import/plugin.php' ) ) {

        deactivate_plugins( plugin_basename( __FILE__ ) );

        function gd_wpai_requires_wpallimport_plugin() {
            echo '<div class="notice notice-warning is-dismissible"><p><strong>' . sprintf( __( '%s requires the %sWP All Import%s plugin to be installed and active.', 'geodir-wpai' ), 'GeoDirectory WP All Import', '<a href="https://wordpress.org/plugins/wp-all-import/" target="_blank" title=" WP All Import">', '</a>' ) . '</strong></p></div>';
        }

        add_action( 'admin_notices', 'gd_wpai_requires_wpallimport_plugin' );
        return;

    }

    // check ayecode_show_update_plugin_requirement function exists or not.
    if (!function_exists('ayecode_show_update_plugin_requirement')) {

        function ayecode_show_update_plugin_requirement() {
            if ( !defined('WP_EASY_UPDATES_ACTIVE') ) {
                echo '<div class="notice notice-warning is-dismissible"><p><strong>'.sprintf( __( 'The plugin %sWP Easy Updates%s is required to check for and update some installed plugins, please install it now.', 'geodir-wpai' ), '<a href="https://wpeasyupdates.com/" target="_blank" title="WP Easy Updates">', '</a>' ).'</strong></p></div>';
            }
        }

        add_action( 'admin_notices', 'ayecode_show_update_plugin_requirement' );

    }

}

if ( ! defined( 'GEODIR_WPAI_VERSION' ) ) {
    define( 'GEODIR_WPAI_VERSION', '2.0.0.0-beta' );
}

if ( ! defined( 'GEODIR_WPAI_PLUGIN_FILE' ) ) {
    define( 'GEODIR_WPAI_PLUGIN_FILE', __FILE__ );
}

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once ( plugin_dir_path( GEODIR_WPAI_PLUGIN_FILE ) . 'includes/class-geodir-wp-all-import.php' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function geodir_load_wp_all_import() {

    GeoDir_WP_All_Import::get_instance();
}
add_action( 'geodirectory_loaded', 'geodir_load_wp_all_import' );