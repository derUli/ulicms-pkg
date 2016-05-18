<?php
	$menus = getAllMenus();
	$new_items = array();
	for($i = 1; $i<=4; $i++){
		if(!in_array("link-list-$i", $menus)){
			$new_items[] = "link-list-$i";
		}
	}
	$additional_menus = Settings::get("additional_menus");
	$additional_menus = $additional_menus .";".implode(";", $new_items);
	$additional_menus = trim($additional_menus, ";");
	Settings::set("additional_menus", $additional_menus);
