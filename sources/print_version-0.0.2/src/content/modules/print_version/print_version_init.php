<?php
if (isset ( $_REQUEST ["print"] )) {
	include_once "templating.php";
	session_start ();
	$_COOKIE [session_name ()] = session_id ();
	
	if (! empty ( $_GET ["language"] )) {
		$_SESSION ["language"] = basename ( $_GET ["language"] );
	}
	
	if (! isset ( $_SESSION ["language"] )) {
		$_SESSION ["language"] = getconfig ( "default_language" );
	}
	
	$cached_page_path = buildCacheFilePath ( $_SERVER ['REQUEST_URI'] );
	
	if (file_exists ( $cached_page_path ) and ! getconfig ( "cache_disabled" ) and getenv ( 'REQUEST_METHOD' ) == "GET") {
		$cached_content = file_get_contents ( $cached_page_path );
		$last_modified = filemtime ( $cached_page_path );
		
		if ($cached_content and (time () - $last_modified < CACHE_PERIOD)) {
			echo $cached_content;
			@include 'cron.php';
			die ();
		}
	}
	
	if (! getconfig ( "cache_disabled" and getenv ( 'REQUEST_METHOD' ) == "GET" ) and ! file_exists ( $cached_page_path )) {
		ob_start ();
	} else if (file_exists ( $cached_page_path )) {
		$last_modified = filemtime ( $cached_page_path );
		if (time () - $last_modified < CACHE_PERIOD) {
			ob_start ();
		}
	}
	
	?>
<html>
<head>
<script type="text/javascript">
window.onload = function(){
   window.print();
}
</script>
<style type="text/css">
a, a:hover, a:visited {
	color: blue;
	text-decoration: none;
}
</style>
<title><?php
	
	title ();
	?></title>
<?php
	base_metas ();
	?>
</head>
<body>
<?php
	content ();
	
	?>
</body>
</html>
<?php
	
	if (file_exists ( $cached_page_path ) and ! getconfig ( "cache_disabled" ) and getenv ( 'REQUEST_METHOD' ) == "GET") {
		$cache_content = ob_get_clean ();
	}
	
	if (! getconfig ( "cache_disabled" ) and ! $hasModul and getenv ( 'REQUEST_METHOD' ) == "GET") {
		$generated_html = ob_get_clean ();
		$handle = fopen ( $cached_page_path, "wb" );
		fwrite ( $handle, $generated_html );
		fclose ( $handle );
		echo ($generated_html);
		@include 'cron.php';
		die ();
	} else {
		@include 'cron.php';
		die ();
	}
}
?>
