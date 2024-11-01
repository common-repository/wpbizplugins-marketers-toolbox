<?php
/*
Plugin Name: WPBizPlugins Marketers Toolbox
Plugin URI: http://www.wpbizplugins.com
Description: Add Facebook conversion pixels and Google AdWords tracking scripts to your pages, posts or custom content.
Version: 0.1
Author: Gabriel Nordeborn
Author URI: http://www.wpbizplugins.com
Text Domain: wpbizplugins-marketers-toolbox
*/

/*  Plugin name: WPBizPlugins Marketers Toolbox
    Copyright 2014  Gabriel Nordeborn  (email : gabriel@wpbizplugins.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Load localization
function wpbizplugins_mtb_init_plugin() {

    load_plugin_textdomain( 'wpbizplugins-marketers-toolbox', false, dirname(plugin_basename(__FILE__)) . '/lang' );

}

add_action( 'init', 'wpbizplugins_mtb_init_plugin' );

/**
 *
 * If ACF isn't active, import ACF.
 * Also load the custom fields.
 * 
 */

function wpbizplugins_mtb_load_acf() {

    if ( ! class_exists( 'Acf' ) ) {

        define( 'ACF_LITE' , true );
        require_once( 'assets/acf/acf.php' );
        
    }

}

add_action( 'plugins_loaded', 'wpbizplugins_mtb_load_acf' );

/**
 *
 * Load a little custom styling
 *
 */

function wpbizplugins_mtb_load_admin_css() {
    
    global $pagenow;
    
    // Only load the admin CSS if we're on the post.php page and thus editing stuff..
    if( $pagenow == "post.php" ) {
        $wpbizplugins_mtb_admin_css_path = plugins_url ('assets/css/admin.css' , __FILE__ );
        wp_enqueue_style( 'admin_css', $wpbizplugins_mtb_admin_css_path, false, '1.0.0' );
    }

}

add_action( 'admin_enqueue_scripts', 'wpbizplugins_mtb_load_admin_css' );

// Import our custom fields
require_once( 'inc/custom-fields.php' );

// Include the various functions for outputing the scripts
require_once( 'inc/facebook-functions.php' );
require_once( 'inc/google-functions.php' ); 
