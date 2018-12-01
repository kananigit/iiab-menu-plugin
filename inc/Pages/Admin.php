<?php

/**
 * @package  IIABMenuPlugin
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminPagesCallbacks;
use Inc\Api\Callbacks\MenuItemsCallbacks;

/**
*
*/

class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_menu;

	public $pages = array();

	public $subpages = array();


	

	public function register() 
	{
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminPagesCallbacks();
		$this->callbacks_menu = new MenuItemsCallbacks();

		$this->setPages();
		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();


		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}


	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'IIAB Menu Plugin', 
				'menu_title' => 'IIAB Menu', 
				'capability' => 'manage_options', 
				'menu_slug' => 'iiab_menu_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-portfolio', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'iiab_menu_plugin', 
				'page_title' => 'Add New Menu Item', 
				'menu_title' => 'Add New Menu', 
				'capability' => 'manage_options', 
				'menu_slug' => 'iiab_add_new', 
				'callback' => array( $this->callbacks, 'adminAddNew' )
			),
			array(
				'parent_slug' => 'iiab_menu_plugin', 
				'page_title' => 'Manage IIAB Server', 
				'menu_title' => 'Manage Server', 
				'capability' => 'manage_options', 
				'menu_slug' => 'iiab_manage_server', 
				'callback' => array( $this->callbacks, 'adminManageServer' )
			)
		);
	}


	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'iiab_menu_items_settings',
				'option_name' => 'iiab_menu_items',
				'callback' => array( $this->callbacks_menu, 'checkboxSanitize' )
			)
		);
		$this->settings->setSettings( $args );
	}	


	public function setSections()
	{
		$args = array(
			array(
				'id' => 'iiab_admin_index',
				'title' => 'Menu Items Manager',
				'callback' => array( $this->callbacks_menu, 'adminSectionManager' ),
				'page' => 'iiab_menu_plugin'
			)
		);
		$this->settings->setSections( $args );
	}


	public function setFields()
	{
		$args = array();
		foreach ( $this->menu_items as $key => $value ) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_menu, 'checkboxField' ),
				'page' => 'iiab_menu_plugin',
				'section' => 'iiab_admin_index',
				'args' => array(
					'option_name' => 'iiab_menu_items',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}
		$this->settings->setFields( $args );
	}


} 