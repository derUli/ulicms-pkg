<?php
$data = get_custom_data ();
$language = getCurrentLanguage ();
if ($language != "de"){
	$language = "en";
};
if (! isset ( $data ["disable_socialshare"] ) and ! isset ( $data ["disable_facebook_like"] ) and ! isset ( $data ["disable_google_plusone"] ) and is_200 ()) {
	?>
<link rel="stylesheet" type="text/css" href="<?php echo getModulePath("shariff");?>shariff.min.css"/>
	<?php
}