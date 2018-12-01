<?php
/**
 * Trigger this file on Plugin uninstall
 *
 * @package  IIABMenuPlugin  
 */


//security check to ensure only authorized personell are trying to uninstall this plugin.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Clear Database stored data. You can do this in two ways.

delete_option( 'iiab_menu_items' );

//The post_type name has to be similar to the unique/slug you used to register the custom post type
// -1 means just get all the posts/menus
/*

//Alternative 1
$hyracboxmenus = get_posts( array( 'post_type' => 'hyracboxmenu', 'numberposts' => -1 ) );


foreach( $hyracboxmenus as $hyracboxmenu ) {
	wp_delete_post( $hyracboxmenu->ID, true );
}

*/


