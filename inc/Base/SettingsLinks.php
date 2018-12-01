<?php
/**
 * @package  IIABMenuPlugin 
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{
	public function register() 
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}

	//Add custom settings link to our plugin in the plugins page. 
	public function settings_link( $links ) 
	{
		$settings_link = '<a href="admin.php?page=iiab_menu_plugin">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}





		/*

		Explanation for the add_filter hook in the register method
		//add a link to settings page of our plugin
		// The format of this filter is plugin_action_links_NAME-OF-MY-PLUGIN
		//This filter will pass a unique array containing all the links inside our list of links in our plugin. By default its normally just Activate/Deactivate and Edit to the callback. This will enable us to create a new link and push it to the array.
		
		We are also pasing the name of the plugin from our variable 'plugin' that we set at the beginning of this class.

		Single quotes don't escape variables. 'plugin_action_links_$this->plugin' will just be read as a string.
		Also note the use of double quotes in this filter. They automatically escape the $ sign for our variable hence we avoid concatnetion all together. If we used single quotes it would be hard to inject a variable into the hook below.

		*/


