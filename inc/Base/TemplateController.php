<?php 
/**
 * @package  IIABMenuPlugin
 */
namespace Inc\Base;

use Inc\Base\BaseController;

class TemplateController extends BaseController
{


	public $templates;


	public function register(){
		//if ( ! $this->activated( 'templates_manager' ) ) return;

		//include location of the template and its unique name
		$this->templates = array(

			'page-templates/page-iiab-home.php' => 'page-iiab-home'

		);

		//integrating the template to the wordpress admin editor window
		//This will also pass an array of all the available templates in our WP installation.S
		add_filter('theme_page_templates', array($this, 'custom_template'));

		add_filter( 'template_include', array( $this, 'load_template' ) );

	}	


	public function custom_template($templates){

		//merge the array of wp templates with the array of your custom templates
		$templates = array_merge($templates, $this->templates);

		return $templates;
	}

	public function load_template( $template )
	{
		global $post;
		if ( ! $post ) {
			return $template;
		}
		// If is the front page, load a custom template
		//check wordpress conditionals to get more flags. You can even check for a specific page
		//Create a switch statements to check for different pages and load different templates.
		if ( is_front_page() ) {
			//$file = $this->plugin_path . 'page-templates/front-page.php';
			$file = $this->plugin_path . 'page-templates/page-iiab-home.php';
			if ( file_exists( $file ) ) {
				return $file;
			}
		}
		
		$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
		if ( ! isset( $this->templates[$template_name] ) ) {
			return $template;
		}
		$file = $this->plugin_path . $template_name;
		if ( file_exists( $file ) ) {
			return $file;
		}
		return $template;
	}	




}
