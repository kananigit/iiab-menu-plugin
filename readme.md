# Internet in a Box Menu Plugin

Wordpress plugin to display Menu items for Internet in a Box server.

After installation and activation of this plugin, you will be able to configure it directly from the Wordpress Admin interface.
Click on the Menu title "IIAB menu" from your sidebar navigation to acess a list menu items with checkboxes enabling you to select or deselect a menu item.

After selecting the menu items you want scroll to the bottom and click "Save Changes".  


# Displaying the Menu Items In the front end

Currently the plugin does not automatically display the menu items in the front page of your wordpress installation. I plan to give the user an option to do that in later versions.

The plugin can display the menu items in any Wordpress page. Just create a new page and select "page-iiab-home" template.

Visit the created page and you will see the selected iiab menu items.



# The instructions below are for the old IIAB Menuing 
You also automatically configure the box/home page when you save your selection of menu Items in the plugin. 

When you save the menu items selection, it also creates a menuItems.json file in /library/www/html/home

You have to slightly alter the index.html in the same directory- /library/www/html/home- for this to work.

Currently we have a hardcoded menuItems array that has menu items we want shown and the rest commented out. 
Save a copy of these original file and delete these array and edit your head tags to look like the code below

        <head>


                <title>Internet in a Box - HOME</title>
                <meta http-equiv="content-type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="/common/css/bootstrap.min.css"/>
                <link rel="stylesheet" href="/common/css/font-awesome.min.css">
                <link rel="stylesheet" href="/common/css/star-rating.min.css" media="all" type="text/css"/>
                <link rel="stylesheet" type="text/css" href="/common/css/xo-common.css">
                <link rel="stylesheet" type="text/css" href="/iiab-menu/menu-files/css/iiab-menu.css">

                <script src="/common/js/jquery.min.js"></script>
                <script src="/common/js/bootstrap.min.js"></script>
                <script src="/common/js/star-rating.min.js" type="text/javascript"></script>

                <script type="text/javascript" language="javascript">

                        var menuItems=[];
                        $.getJSON("menuItems.json")
                        .done(function( data ) {
                                //console.log(data);
                                for(var i=0; i < data.menus_array.length; i++){
                                        menuItems[i]=data.menus_array[i];
                                }

                                var script = document.createElement('script');
                                script.onload = function () {
                                        //do stuff with the script
                                };
                                script.src = "/iiab-menu/menu-files/js/iiab-menu.js";
                                document.head.appendChild(script);

                                //For older browsers (IE < 9 etc.) that doesn't support document.head
                                //document.getElementsByTagName("head")[0].appendChild(script);

                                })
                        .fail(function(){  console.log("Error loading json file");  });

                </script>
        </head>
    
Thats all you have to do and now whenever you update your list of menu items from the Wordpress plugin, the changes will show in the iiab homepage in 172.18.96.1/home  


# New IIAB Menuing system
The plugin works just fine in the new Menuing system if you are just concerned about wordpress.  It however does not automatically configure the box/home   page.


# Improvements
Currently your menu items will show in wordpress using the images at https://github.com/iiab/iiab-menu/tree/master/menu-files/images . 

Most of them are meant to be logos and they might be blurry since they have a very small resolution. I have started to create a version of the images that has a 
higer resolution so that they look better in wordpress.

But am only doing a couple that i normally use. I will share a link to that soon.
