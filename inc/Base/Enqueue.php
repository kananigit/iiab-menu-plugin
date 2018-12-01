<?php

/**
 * @package  IIABMenuPlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
*
*/

class Enqueue extends BaseController
{



	public function register(){

 		//to enqueue scripts for the frontend use wp_enqueue_scripts instead
 		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
 		//enqueue scripts for front end
 		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFrontend' ) );		
	}

	//Add scripts & styles for the plugin backend
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'iiabmenupluginstyles', $this->plugin_url. 'assets/iiabmenustyles.css' );
		wp_enqueue_script( 'iiabmenupluginscript', $this->plugin_url. 'assets/iiabmenuscript.js' );


	}


	//Add scripts and styles for the front end
	function enqueueFrontend(){
		
            wp_enqueue_style( 'iiab_bootstrapv4js', $this->plugin_url. 'assets/bootstrap.min.css' );
            wp_enqueue_script( 'iiab_bootstrapv4css', $this->plugin_url. 'assets/bootstrap.min.js' );
	}



}
