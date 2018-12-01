<?php
/**
 * @package  IIABMenuPlugin
 */
/*
Plugin Name: IIAB Menu Plugin
Plugin URI: https://github.com/kananigit/iiab-menu-plugin
Description: Wordpress plugin to create Menu items for Internet in a Box server.
Version: 1.0.0
Author: Joshua Kanani
Author URI: http:jkanani.me
License: GPLv2 or later
Text Domain: iiab-menu-plugin
*/


/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/




/*Ensure only authorized personel are accessing functionalities of this plugin*/
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you are not authorized!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


/**
 * The code that runs during plugin activation
 */
function activate_iiab_menu_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_iiab_menu_plugin' );
/**
 * The code that runs during plugin deactivation
 */
function deactivate_iiab_menu_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_iiab_menu_plugin' );



/**
 * Initialize all the core classes of the plugin
 */
if(class_exists ('Inc\\Init')){
	//we consider the different classes we have as services and we register them in register_services method in Init class.
	Inc\Init::register_services();
}
