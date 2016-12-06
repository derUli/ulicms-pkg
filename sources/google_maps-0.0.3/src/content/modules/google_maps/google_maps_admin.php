<?php
define ( "MODULE_ADMIN_HEADLINE", "Google Maps" );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "google_maps" );
function google_maps_admin() {
	if (isset ( $_POST ["submit"] )) {
		setconfig ( "google_maps_marker", db_escape ( $_POST ["google_maps_marker"] ) );
		
		setconfig ( "google_maps_zoom_level", intval ( $_POST ["google_maps_zoom_level"] ) );
	}
	
	$google_maps_marker = getconfig ( "google_maps_marker" );
	
	$google_maps_zoom_level = getconfig ( "google_maps_zoom_level" );
	$google_maps_zoom_level = intval ( $google_maps_zoom_level );
	
	?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
	
	csrf_token_html ();
	?>
<p>
		<strong><?php translate("ADDRESS_TOWN");?></strong> <br /> <input
			type="text" name="google_maps_marker"
			value="<?php
	
	echo htmlspecialchars ( $google_maps_marker );
	?>">
	</p>

	<p>
		<strong><?php translate("ZOOM_LEVEL");?></strong> <br /> <select
			name="google_maps_zoom_level">
<?php
	
	for($i = 0; $i <= 21; $i ++) {
		?>
<option value="<?php
		
		echo $i;
		?>"
				<?php
		
		if ($i == $google_maps_zoom_level)
			echo "selected";
		?>
				size="1"><?php
		
		echo $i;
		?></option>
<?php
	}
	?>
</select>
	
	
	<p>
		<input type="submit" name="submit" value="<?php translate("save");?>" />
	</p>
</form>
<?php
}

?>