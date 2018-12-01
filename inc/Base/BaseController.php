<?php 
/**
 * @package  IIABMenuPlugin
 */
namespace Inc\Base;

//defining the plugin paths will help you navigate to it easily from your classes
class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;
	public $menu_items = array();

	public function __construct() {
		//we use '2' with the __FILE because we are indented 2 levels below the plugin base directory.
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		//this is not the most optimum solution but it works..
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ). '/iiab-menu-plugin.php';

		$this->menu_items = array(

			'en-usb' => 'en-usb',
			'en-afristory-za' => 'en-afristory-za',
			'en-afristory' => 'en-afristory',
			'en-asst_medical' => 'en-asst_medical',
			'en-ck12' => 'en-ck12',
			'en-ebooks' => 'en-ebooks',
			'en-edison' => 'en-edison',
			'en-elgg' => 'en-elgg',
			'en-fairshake' => 'en-fairshake',
			'en-GCF2015' => 'en-GCF2015',
			'en-gutenberg_en_all' => 'en-gutenberg_en_all',
			'en-healthphone' => 'en-healthphone',
			'en-hesperian_health' => 'en-hesperian_health',
			'en-iicba' => 'en-iicba',
			'en-infonet' => 'en-infonet',
			'en-kalite' => 'en-kalite',
			'en-kalite-india' => 'en-kalite-india',
			'en-kalite-ess' => 'en-kalite-ess',
			'en-kalite-sample-videos' => 'en-kalite-sample-videos',
			'en-kalite_health' => 'en-kalite_health',
			'en-law_library' => 'en-law_library',
			'en-math_expression' => 'en-math_expression',
			'en-medline_plus-static' => 'en-medline_plus-static',
			'en-medline_plus' => 'en-medline_plus',
			'en-moodle' => 'en-moodle',
			'en-musictheory' => 'en-musictheory',
			'en-nextcloud' => 'en-nextcloud',
			'en-osm' => 'en-osm',
			'en-owncloud' => 'en-owncloud',
			'en-oya' => 'en-oya',
			'en-phet_html' => 'en-phet_html',
			'en-practical_action' => 'en-practical_action',
			'en-radiolab' => 'en-radiolab',
			'en-saylor' => 'en-saylor',
			'en-scale-of-universe' => 'en-scale-of-universe',
			'en-scratch' => 'en-scratch',
			'en-sugarizer' => 'en-sugarizer',
			'en-tedmed_en_all' => 'en-tedmed_en_all',
			'en-ted_en_science' => 'en-ted_en_science',
			'en-understanding_algebra' => 'en-understanding_algebra',
			'en-worldmap_8' => 'en-worldmap_8',
			'en-wiktionary_en_all' => 'en-wiktionary_en_all',
			'en-wikivoyage_en_all' => 'en-wikivoyage_en_all',
			'en-wikiversity_en_all' => 'en-wikiversity_en_all',
			'en-wikispecies_en_all' => 'en-wikispecies_en_all',
			'en-wikisource_en_all' => 'en-wikisource_en_all',
			'en-wikipedia_en_medicine' => 'en-wikipedia_en_medicine',
			'en-wikipedia_en_for_schools' => 'en-wikipedia_en_for_schools',
			'en-wikipedia_en_all' => 'en-wikipedia_en_all',
			'en-wikibooks_en_all' => 'en-wikibooks_en_all',
			'en-credits' => 'en-credits'
		);

	}



}