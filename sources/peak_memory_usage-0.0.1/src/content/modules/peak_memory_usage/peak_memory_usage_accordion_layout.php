<?php
$acl = new ACL ();

if ($acl->hasPermission ( "peak_memory_usage" )) {
	$data = Settings::get ( "peak_memory_usage" );
	if ($data) {
		$data = formatSizeUnits ( $data );
	} else {
		$data = "No Data";
	}
	?>

<h2 class="accordion-header">Peak Memory Usage</h2>
<div class="accordion-content"><?php echo $data;?>
</div>
<?php
}
?>