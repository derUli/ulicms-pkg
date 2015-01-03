<?php
$template = file_get_contents(getModulePath("humanstxt"). "/robots.txt");

$file = ULICMS_ROOT. "/humans.txt";
if(!file_exists($humans_txt)){
  echo "Erstelle humans.txt Vorlage";
  file_put_contents($file, $template);
  echo "Fertig";
}

echo "humans.txt existiertbereits";
