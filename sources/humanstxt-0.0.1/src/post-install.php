<?php
$template = file_get_contents(getModulePath("humanstxt") . "/template.txt");

$file = ULICMS_ROOT . "/humans.txt";
if(!file_exists($file)){
     echo "Erstelle humans.txt Vorlage";
     file_put_contents($file, $template);
     echo "Fertig";
     }
else{
     echo "humans.txt existiert bereits";
     }
