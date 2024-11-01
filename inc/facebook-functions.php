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
 * The function that adds the Facebook conversion pixels if they are set.
 *
 */

function wpbizplugins_mtb_facebook_conversion_pixels() {

    global $post;
    
    // Check whether we should add the tracking pixel or not
    if( get_post_meta( $post->ID, 'facebook_add_tracking_pixel', true ) == 1 ) {
        
        // Get the script attached to the content, and output it
        $wpbizplugins_mtb_script = get_post_meta( $post->ID, 'facebook_tracking_pixel_script', true );
        echo $wpbizplugins_mtb_script;
    
    }
    
    unset($post);

}

if( ! is_admin() ) add_action('wp_head', 'wpbizplugins_mtb_facebook_conversion_pixels');

