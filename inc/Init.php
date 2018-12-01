<?php


/**
 * @package  IIABMenuPlugin 
 */

namespace Inc;

//We don't want this class to be extended by any class whatsoever. Hence use of Final.
final class Init
{

	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services()
	{

		return [

			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\TemplateController::class
		];		
	}

	//if a class is initialized we use 'this' keyword to refer to variables & methods but if its not we use 'self' 

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}
	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();
		return $service;
	}



}//end class init






