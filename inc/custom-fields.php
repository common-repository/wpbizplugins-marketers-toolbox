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
 * Anything in this file will automatically be executed after plugins have been loaded.
 *
 */
 
// Get all custom post types.
add_action( 'admin_init', 'wpbizplugins_mtb_load_acf_custom_fields' );

function wpbizplugins_mtb_load_acf_custom_fields() {

    // Only grab public post types, and ignore the ones built into WordPress
    $args = array(
       'public'   => true,
       '_builtin' => false
    );

    $wpbizplugins_mtb_post_types = get_post_types( $args, 'names' );

    // Add the standard Page and Post separately
    $wpbizplugins_mtb_post_types[] = "post";
    $wpbizplugins_mtb_post_types[] = "page";

    // Set up an array with all the custom post types that are available
    $x = 0;
    foreach( $wpbizplugins_mtb_post_types as $post_type ) {

        $wpbizplugins_mtb_location_array[] =	array (
			                    array (
				                    'param' => 'post_type',
				                    'operator' => '==',
				                    'value' => $post_type,
				                    'order_no' => 0,
				                    'group_no' => $x,
			                    ),
		                    );
		
        $x++;

    }

    /**
     *
     * Register the custom fields needed.
     *
     */
     
    // The intro screen
    
    $wpbizplugins_mtb_logo_path = plugins_url ('../assets/img/wpbizplugins-marketers-toolbox-logo.png' , __FILE__ );
    
    if(function_exists("register_field_group"))
    {
	    register_field_group(array (
		    'id' => 'wpbizplugins_marketers_toolbox',
		    'title' => 'WPBizPlugins Marketers Toolbox',
		    'fields' => array (
			    array ( // The welcome message
				    'key' => 'field_5331861935487',
				    'label' => '',
				    'name' => '',
				    'type' => 'message',
				    'message' => '<div><a target="_blank" href="http://www.wpbizplugins.com"><img src="' . $wpbizplugins_mtb_logo_path . '"></a></div><hr /><p>' . __('Welcome to the Marketers Toolbox! You can easily add Facebook or Google AdWords conversion tracking to any piece of content on your website from here. Find more WordPress plugins to simplify working with your business website at ', 'wpbizplugins-marketers-toolbox') . '<a target="_blank" href="http://www.wpbizplugins.com">WPBizPlugins.com</a>.</p><p>' . __('Do you need help, have suggestions for features, or have other comments? Send an email to', 'wpbizplugins-marketers-toolbox') . ' <a href="mailto:support@wpbizplugins.com?subject=WPBizPlugins Marketers Toolbox">support@wpbizplugins.com</a>.</p><hr/>'
			    ),
			    array ( // The Facebook tracking pixel
			        'key' => 'field_532eeaa25cb46',
			        'label' => __('Add Facebook tracking pixel', 'wpbizplugins-marketers-toolbox'),
			        'name' => 'facebook_add_tracking_pixel',
			        'type' => 'true_false',
			        'instructions' => __('Select this if you want to add a Facebook Tracking Pixel to this page.', 'wpbizplugins-marketers-toolbox'),
			        'message' => '',
			        'default_value' => 0,
            
		        ),
		        array (
			        'key' => 'field_532eeac65cb47',
			        'label' => __('Facebook Tracking Pixel Script'),
			        'name' => 'facebook_tracking_pixel_script',
			        'type' => 'textarea',
			        'instructions' => __('Copy and paste the pixel script you get from Facebook into this box.', 'wpbizplugins-marketers-toolbox'),
			        'conditional_logic' => array (
				        'status' => 1,
				        'rules' => array (
					        array (
						        'field' => 'field_532eeaa25cb46',
						        'operator' => '==',
						        'value' => '1',
					        ),
				        ),
				        'allorany' => 'all',
			        ),
			        'default_value' => '',
			        'placeholder' => '',
			        'maxlength' => '',
			        'rows' => '',
			        'formatting' => 'none',
		        ),
		        
		        array ( // The Google Conversion script code
			        'key' => 'field_53301a835868b',
			        'label' => __('Add Google conversion code', 'wpbizplugins-marketers-toolbox'),
			        'name' => 'google_adwords_add_tracking',
			        'type' => 'true_false',
			        'instructions' => __('Select this if you want to add Google AdWords Conversion Tracking.', 'wpbizplugins-marketers-toolbox'),
			        'message' => '',
			        'default_value' => 0,
		        ),
		        array (
			        'key' => 'field_53301b325868c',
			        'label' => __('Google AdWords Tracking code', 'wpbizplugins-marketers-toolbox'),
			        'name' => 'google_adwords_tracking_code',
			        'type' => 'textarea',
			        'instructions' => __('Copy and paste the code you get from Google AdWords into this box.', 'wpbizplugins-marketers-toolbox'),
			        'conditional_logic' => array (
				        'status' => 1,
				        'rules' => array (
					        array (
						        'field' => 'field_53301a835868b',
						        'operator' => '==',
						        'value' => '1',
					        ),
				        ),
				        'allorany' => 'all',
			        ),
			        'default_value' => '',
			        'placeholder' => '',
			        'maxlength' => '',
			        'rows' => '',
			        'formatting' => 'none',
		        ),
		        array (
			        'key' => 'field_53301bb75868d',
			        'label' => __('Method to add the Google AdWords tracking code', 'wpbizplugins-marketers-toolbox'),
			        'name' => 'method_to_add_the_code',
			        'type' => 'radio',
			        'instructions' => __('You can have the code automatically inserted on the page, or you can choose to insert the code manually via a shortcode.', 'wpbizplugins-marketers-toolbox') . '<em> ' . __('Use the shortcode if automatically inserting the code gives visual problems on your website.', 'wpbizplugins-marketers-toolbox') . '</em>',
			        'conditional_logic' => array (
				        'status' => 1,
				        'rules' => array (
					        array (
						        'field' => 'field_53301a835868b',
						        'operator' => '==',
						        'value' => '1',
					        ),
				        ),
				        'allorany' => 'all',
			        ),
			        'choices' => array (
				        'Automatically insert code' => __('Automatically insert code', 'wpbizplugins-marketers-toolbox'),
				        'Insert code manually using shortcode' => __('Insert code manually using shortcode', 'wpbizplugins-marketers-toolbox'),
			        ),
			        'other_choice' => 0,
			        'save_other_choice' => 0,
			        'default_value' => 'Automatically insert code',
			        'layout' => 'vertical',
		        ),
		        array (
			        'key' => 'field_53301c825868e',
			        'label' => __('Shortcode', 'wpbizplugins-marketers-toolbox'),
			        'name' => 'shortcode',
			        'type' => 'text',
			        'instructions' => __('Copy this shortcode and put it whereever you want on your page.', 'wpbizplugins-marketers-toolbox'),
			        'conditional_logic' => array (
				        'status' => 1,
				        'rules' => array (
					        array (
						        'field' => 'field_53301bb75868d',
						        'operator' => '==',
						        'value' => 'Insert code manually using shortcode',
					        ),
					        
					        array (
						        'field' => 'field_53301a835868b',
						        'operator' => '==',
						        'value' => '1',
					        ),
				        ),
				        'allorany' => 'all',
			        ),
			        'default_value' => '[wpbizplugins_google_adwords_conversion_code]',
			        'placeholder' => '',
			        'prepend' => '',
			        'append' => '',
			        'formatting' => 'none',
			        'maxlength' => '',
		        ),		        
		        
		    ),
		    
		    'location' => $wpbizplugins_mtb_location_array,
		    'options' => array (
			    'position' => 'normal',
			    'layout' => 'no_box',
			    'hide_on_screen' => array (
			    ),
		    ),
		    'menu_order' => 1,
	    ));
    }

}

