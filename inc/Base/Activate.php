<?php
/**
 * @package  IIABMenuPlugin
 */

namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		//check if the wp option exist. If it does not, initialize it with an empty array
		if ( get_option( 'iiab_menu_items' ) ) {
			return;
		}
		$default = array();
		update_option( 'iiab_menu_items', $default );

		
	}
}
