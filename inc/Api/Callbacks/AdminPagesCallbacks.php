<?php

/**
 * @package  IIABMenuPlugin
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminPagesCallbacks extends BaseController 
{


	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}
	public function adminAddNew()
	{
		return require_once( "$this->plugin_path/templates/add_new.php" );
	}
	public function adminManageServer()
	{
		return require_once( "$this->plugin_path/templates/manage_server.php" );
	}



}