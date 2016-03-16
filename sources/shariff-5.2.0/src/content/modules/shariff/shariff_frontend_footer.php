<?php
$data = get_custom_data ();
$language = getCurrentLanguage ();
if ($language != "de"){
	$language = "en";
};
if (! isset ( $data ["disable_socialshare"] ) and ! isset ( $data ["disable_facebook_like"] ) and ! isset ( $data ["disable_google_plusone"] ) and is_200 ()) {
	?>
<script type="text/javascript"
	src="<?php echo getModulePath("shariff");?>shariff.min.js"></script><?php
}