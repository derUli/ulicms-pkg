<?php

$files = scandir(".");

foreach($files as $file){
   $old_src_dir = $file."/src";
   $old_module_dir =  $old_src_dir."/modules";
   $old_templates_dir = $old_src_dir."/templates";
   $new_content_dir = $old_src_dir."/content";
   if(!is_dir($new_content_dir)){
      mkdir($new_content_dir);
   }
   if(file_exists($old_module_dir)){
       $new_module_dir = $new_content_dir."/modules";
       echo $old_module_dir . " => " . $new_module_dir;
       rename($old_module_dir, $new_module_dir);
       echo "\n";
   }

   if(file_exists($old_templates_dir)){
       $new_templates_dir = $new_content_dir."/templates";
       echo $old_templates_dir . " => " . $new_templates_dir;
       rename($old_templates_dir, $new_templates_dir);
       echo "\n";
   }
     }

