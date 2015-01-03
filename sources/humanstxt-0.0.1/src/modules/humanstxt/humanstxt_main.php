<?php
function humanstxt_render(){
     $file = ULICMS_ROOT . "/humans.txt";
     $html = "humans.txt existiert nicht";
     if(file_exists($file)){
         $html = nl2br(htmlspecialchars(file_get_contents($file))) ;
         }
     return $html;
    }
