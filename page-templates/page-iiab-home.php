<?php 
/**
 * The template for displaying IIAB Menu items
 * Template Name: page-iiab-home
 * @version 1.0
 */


get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
    	<main id="main" class="site-main" role="main">
  			<div class="container">
			<div class="card-columns">

				<?php
				 

					//get the url of the wordpress site dynamically 
					$parts = parse_url(site_url());
					$domain_url = $parts['scheme'] . '://' . $parts['host'];


					// constants
					$zimVersionIdx = $domain_url. "/common/assets/zim_version_idx.json";
					$htmlBaseUrl = $domain_url. "/modules/";
					$webrootBaseUrl = $domain_url. "/";
					$apkBaseUrl = $domain_url. "/content/apk/";
					$menuUrl = $domain_url. '/iiab-menu/menu-files/';
					$configJson = $domain_url. '/iiab-menu/config.json';
					$defUrl = $menuUrl. 'menu-defs/';
					$imageUrl = $menuUrl. 'images/';
					$menuServicesUrl =  $menuUrl. 'services/';
					$iiabMeterUrl = $domain_url. "/iiab_meter.php";
					$undefinedPageUrl = $domain_url. "/iiab-menu/menu-files/html/undefined.html";


					//host is the same as domain url, used it just to be consistent with iiab
					$host = $domain_url;
					$menuHtml = "";
					$menuConfig = new stdClass();
					$menuDefs = new stdClass();
					$zimVersions = new stdClass();

					//variable to store the menu items from the wp options
					//THIS IS A WORDPRESS METHOD
					$iiab_menu_options = get_option( 'iiab_menu_items' );

					//array containing the menu Items
					$menuItems = array();

					//check if there is an array of menu items in the wp_options table in the db
					if ( isset ($iiab_menu_options ) ){

						//var_dump($hyrac_menu_options);

						foreach ( $iiab_menu_options as $key => $value ) {

							if($value == true){
								$menuItems[] = $key;
							} 
								//echo $key; echo '<br>';
						}

					}



					if(isset($menuItems)){

					//echo "$undefinedPageUrl";
						$menuConfig =json_decode(file_get_contents("$configJson"));

						//check if indeed it got something...
						$apkBaseUrl = $menuConfig->apkBaseUrl;


						$zimVersions =json_decode(file_get_contents("$zimVersionIdx"));


						//echo "$apkBaseUrl";



						//main processing of the menus
						$html = "";
						//$array_length = count($);

						for ($i = 0; $i < count($menuItems); $i++) {
							$menu_item_name = $menuItems[$i];
							$menuDefs->$menu_item_name = new stdClass();
							$menuItemDivId = $i. "-". $menu_item_name;
							$menuDefs->$menu_item_name->menu_id = $menuItemDivId;
							

							//html += '<div id="' + menuItemDivId + '" class="content-item" dir="auto">&emsp;Attempting to load ' + menu_item_name + ' </div>';

						//echo "$menuItems[$i] /n ";
						}


						function procMenu() {
							global $menuItems;

							for ($i = 0; $i <  count($menuItems); $i++) {
								
								getMenuDef($menuItems[$i]);
								//echo "$menuItems[$i] \n";
							}
						}//end procMenu



						function getMenuDef($menuItem) {

							//echo "$menuItem \n";
							global $enusb;
							global $defUrl;    
							global $menuDefs;
							$module;
							$menuId = $menuDefs->$menuItem->menu_id; // save this value


							//print_r($menuDefs);
							//print_r($menuDefs->$menuItem);
							//$menuConfig =json_decode(file_get_contents("$configJson"));	

							/*dO SOME CHECKS/VALIDATION*/	
							$cast_object = json_decode(file_get_contents($defUrl.$menuItem. ".json"));
							//print_r($cast_object);
							$menuDefs->$menuItem = $cast_object;
							$menuDefs->$menuItem->menu_item_name = $menuItem;
							$menuDefs->$menuItem->add_html = "";
							$menuDefs->$menuItem->menu_id = $menuId;
							$module = $menuDefs->$menuItem;        
							procMenuItem($module);	
							//echo $menuDefs->$menuItem->menu_id; echo "<br>";
							//print_r($module);
						}//end getMenuDef function



						function procMenuItem($module) {
							$menuHtml = "";
							$langClass = "";

							$menuItemDivId = "#".$module->menu_id;

							//echo $menuItemDivId; echo "<br>";
							if (strcmp($module->intended_use, "zim") == 0)
								calcZimLink($module);
							else if (strcmp($module->intended_use, "html") == 0)
								calcHtmlLink($module);
								else if (strcmp($module->intended_use, "webroot") == 0)
								calcWebrootLink($module);
							else if (strcmp($module->intended_use, "kalite") == 0)
								calcKaliteLink($module);
								else if (strcmp($module->intended_use, "calibre") == 0)
								calcCalibreLink($module);
							else if (strcmp($module->intended_use, "osm") == 0)
								calcOsmLink($module);
							else if (strcmp($module->intended_use, "info") == 0)
								calcInfoLink($module);
							//else
								//menuHtml += '<div class="content-item" style="padding:10px; color: red; font-size: 1.5em">' +  module['menu_item_name'] + ' - unknown module type</div>';

							//langClass = 'lang_' + module.lang;
							//$(menuItemDivId).addClass(langClass);
							//$(menuItemDivId).html(menuHtml);
							//getExtraHtml(module);


						}


						function calcZimLink($module){
							global $zimVersions;
							global $menuConfig;
							global $host;
							global $undefinedPageUrl;

							// if kiwix_url is defined use it otherwise use port
							if(isset($zimVersions->{$module->zim_name})){
								$href =  $zimVersions->{$module->zim_name}.'/';
								//echo $href;
									if ( isset($menuConfig->kiwixUrl)){
								  	  $href = $menuConfig->kiwixUrl.$href;
								  //echo $href;
									}else{
								  	  $href = $host.':'.$menuConfig->kiwixPort.'/'.$href;
									}
							}
							else
							 $href = $undefinedPageUrl.'?menu_item='.$module->menu_item_name.'&zim_name='.$module->zim_name; //not defined in zimVersions

							calcLink($href,$module);


						}//end calcZimLink function


						function calcHtmlLink($module){
							global $htmlBaseUrl;
							$href = $htmlBaseUrl.$module->moddir;
							calcLink($href,$module);
						}

						function calcWebrootLink($module){
							global $webrootBaseUrl;
							$href = $webrootBaseUrl.$module->moddir;
							calcLink($href,$module);
						}

						function calcKaliteLink($module){
							global $host;
							global $menuConfig;

							$portRef = $module->lang.'-kalitePort';	
							$href = $host.':';
							if (isset($menuConfig->$portRef))
								$href = $href.$menuConfig->$portRef;
							else
								$href =$href.$menuConfig->en-kalitePort;
								//echo $href;
							calcLink($href,$module);

						}

						function calcCalibreLink($module){
						    global $host;
						    global $menuConfig;

							//print_r($module);
							$href = $host.':'.$menuConfig->calibrePort;

							calcLink($href,$module);
						}



						function calcOsmLink($module){
							$href = '/iiab/static/map.html';
							calcLink($href,$module);
						}


						function calcInfoLink($module){
							$href = null;
							calcLink($href,$module);
						}


							function calcLink($href,$module){
								global $menuDefs;
								global $imageUrl;

								$startPage = $href;

								// record href for extra html
								$menuDefs->{$module->menu_item_name}->href = $href;
								//print_r($menuDefs->{$module->menu_item_name}); echo "<br>";

								/*	
								// a little kluge but ignore start_url if is dummy link to undefinedPageUrl
								if ($href != undefinedPageUrl){
									if (module.hasOwnProperty("start_url")){
									  if (startPage[startPage.length - 1] == '/')
									    startPage = startPage.substr(0,startPage.length - 1); // strip final /
									  if (module['start_url'][0] != '/')
									    startPage = startPage + '/' + module['start_url'];
									  else
									  	startPage = startPage + module['start_url'];
								}
								}
								*/

				?>



									<div class="card">

				<?php

										if (isset($href))
										//  $html+='<a href="' + startPage + '"><img src="' + imageUrl + module.logo_url + '" alt="' + module.title + '"></div>';
										    echo '<a href="'.$startPage.'"> <img class="card-img-top img-fluid" src="'.$imageUrl.$module->logo_url.'" alt="'.$module->title.'"> </a>';
										else
										//	$html+='<img src="' + imageUrl + module.logo_url + '" alt="' + module.title + '"></div>';
											echo '<img class="card-img-top" src="'.$imageUrl.$module->logo_url.'" alt="'.$module->title.'">';
										//echo '<hr class="my-4">';
										echo '<div class="card-body">';

										//content i.e title and description
										//menu-item Title
										if (isset($href))
										  echo '<a href="'.$startPage.'"> <h2 class="card-title" >'.ucfirst($module->title).'</h2> </a>';
										else
										  echo '<h2 class="card-title" >'.ucfirst($module->title).'</h2>';


										//description of the menu item
										echo '<p class="card-text">'.ucfirst($module->description). '</p>';
										echo '</div>'; //end div -card-body

										/*	//check if menu definition has apk file
										if (module.hasOwnProperty("apk_file")){
											var sizeClause = '';
											if (module.hasOwnProperty("apk_file_size"))
											  sizeClause = ' (' + module.apk_file_size + ')';
											if (menuConfig['apkLinkPhrase'].hasOwnProperty(module.lang))
											  html+='<p>' + menuConfig['apkLinkPhrase'][module.lang] + ' <span dir="ltr"><a href="' + apkBaseUrl + module.apk_file + '">' + module.apk_file + sizeClause + '</a></span></p>';
										  else
										  	html+='<p>Click here to download <a href="' + apkBaseUrl + module.apk_file + '">' + module.apk_file + '</a></p>';
										}

										consoleLog('href = ' + href);
										//if there is extra html page to be loaded
										html += '<div id="' + module.menu_id + '-htmlf" class="toggleExtraHtml"></div>'; // scaffold for extra html

										html+='</div>';  //end content-cell div
										*/



				?>


									</div><!-- card-->



				<?php


						//return $html;
						}//end calcLink function


						procMenu();

					}else{

						var_dump('There Menu Items array is empty');

					}//end isset($menuItems) to check if make sure the array is not empty

	



 				?>
	
		</div><!-- card-columns-->
        	</div><!-- container-->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();

