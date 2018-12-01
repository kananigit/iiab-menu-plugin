<div class="wrap">
	
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<form method="post" action="options.php">
				<?php 
					settings_fields( 'iiab_menu_items_settings' );
					do_settings_sections( 'iiab_menu_plugin' ); 
					submit_button();
					//After the changes are submitted write the menuItems to the menuitems.json
					//In future put this functionality in its own class

                    //array containing the menu Items
                    $menuItems = array();

                    //check if there is an array of menu items in the wp_options table in the db
                    if ( get_option( 'iiab_menu_items' ) !== null ){

                            $iiab_menu_options = get_option( 'iiab_menu_items' );

                            if (empty($iiab_menu_options)) {

                                    echo '<h1>' . "No Menu Item Selected." . '</h1>';
                            }
                            //var_dump( $iiab_menu_options);

                            foreach ( $iiab_menu_options as $key => $value ) {

                                    if($value == true){
                                            $menuItems[] = $key;
                                    } 
                                            //echo $key; echo '<br>';
                            }

                            if(!$menuItems){ return;}

                            $menuData = array();
                            $menuData['menus_array'] = $menuItems;
                            //format the data
                            $formattedData = json_encode($menuData);

                            $parts = parse_url(site_url());
                            $domain_url = $parts['scheme'] . '://' . $parts['host'];

                            //set the filename
                            $filename = '/library/www/html/home/menuItems.json';
                            //open or create the file
                            $handle = fopen($filename,'w+');

                            //write the data into the file
                            fwrite($handle,$formattedData);

                            //close the file
                            fclose($handle);

                     }//end if
				?>
			</form>
			
		</div>

		<div id="tab-2" class="tab-pane">
			<h3>Updates</h3>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div>
	</div>
</div>
