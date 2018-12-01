<?php
/**
 * @package  IIABMenuPlugin
 */

namespace Inc\Base;

class Deactivate
{
	public static function deactivate() {
		flush_rewrite_rules();

		//delete_option( 'hyracbox_menu_items' );
	}
}
