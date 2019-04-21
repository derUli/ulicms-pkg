<?php

$q = $_GET ["q"];

$file = dirname(__file__). "/index.json";

$data = json_decode(file_get_contents($file));
$result = null;

foreach($data as $package){
	if($package->name === $q){
		$result = $package->version;
		break;
	}
}

if ($result) {
	header ( "HTTP/1.0 200 OK" );
	echo $result;
} else {
	header ( "HTTP/1.0 404 Not Found" );
}
exit ();