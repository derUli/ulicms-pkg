<?php
function splitPackageName($name) {
		$name = str_ireplace ( ".tar.gz", "", $name );
		$name = str_ireplace ( ".zip", "", $name );
		$splitted = explode ( "-", $name );
		$version = array_pop ( $splitted );
		$name = $splitted;
		return array (
				join ( "-", $name ),
				$version 
		);
	}

$q = $_GET["q"];

$modules = array();

$file = file_get_contents("list.txt");
$file = str_replace("\r\n", "\n", $files);
$file = explode("\n", $file);
sort($file);

foreach($files as $line){
   $splitted = splitPackageName($line);
   $modules[$splitted[0]] = $modules[$splitted[1]];
}
if(isset($modules[$q]) and !empty($modules[$q])){
   header("HTTP/1.0 200 OK");
   echo $modules[$q];
} else {
      header("HTTP/1.0 404 Not Found");
}
exit();