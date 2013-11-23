<?php
$allpages = getAllSystemNames();
if(containsModule(get_requested_pagename(), "random_page") or isset($_GET["view_random_page"]) ){
   $random = null;
   do{
     $random = array_rand($allpages, 1);
     $random = $allpages[$random];
   } while(containsModule($random));
   
   header("Location: ".buildSEOUrl($random));
   exit();
   
}