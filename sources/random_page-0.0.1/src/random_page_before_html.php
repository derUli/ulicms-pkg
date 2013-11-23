<?php
if(containsModule(get_requested_pagename(), "random_page") or isset($_GET["view_random_page"])){
   $allpages = getAllSystemNames();
   $random = null;
   do{
     $random = array_rand($allpages);
     $random = $allpages[$random];
   } while($random != get_requested_pagename());
   
   $_GET["seite"] = $random;
}