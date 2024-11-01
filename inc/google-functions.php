<?php

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

/**
 *
 * Add the Google conversion tracking if warranted.
 *
 */

// Function for the automatic output at bottom of page
function wpbizplugins_mtb_google_adwords_conversion_tracking() {

    global $post;
    
    // Check whether we should add the tracking pixel or not
    if( get_post_meta( $post->ID, 'google_adwords_add_tracking', true ) == 1 ) {
        
        // Check if the code should be added automatically, or added via the shortcode
        if( get_post_meta( $post->ID, 'method_to_add_the_code', true ) == "Automatically insert code" ) {
        
            // Get the script attached to the content, and output it
            $wpbizplugins_mtb_script = get_post_meta( $post->ID, 'google_adwords_tracking_code', true );
            echo $wpbizplugins_mtb_script;
            
        }
    
    }
    
    unset($post);

}

if( ! is_admin() ) add_action('wp_footer', 'wpbizplugins_mtb_google_adwords_conversion_tracking');

/**
 *
 * Add the necessary shortcode.
 *
 */

function wpbizplugins_google_adwords_conversion_code_shortcode( $atts ) {
    
    global $post;
    
    $wpbizplugins_mtb_script = get_post_meta( $post->ID, 'google_adwords_tracking_code', true );
    
    // Start the caching so the output ends up in the right place
    ob_start();
    
    echo $wpbizplugins_mtb_script;
    
    // End the caching and throw it all back to the right place, yo!
    $output_string = ob_get_contents();
    ob_end_clean();
    
    unset($post);

    return $output_string;

}

add_shortcode( 'wpbizplugins_google_adwords_conversion_code', 'wpbizplugins_google_adwords_conversion_code_shortcode' );
