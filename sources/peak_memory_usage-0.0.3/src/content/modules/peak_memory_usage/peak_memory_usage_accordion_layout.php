<?php
include_once getModulePath ( "peak_memory_usage" ) . "/objects/peak_memory_usage.php";

$acl = new ACL ();
if ($acl->hasPermission ( "peak_memory_usage" )) {
	
	$min = formatSizeUnits ( PeakMemoryUsage::getMinimalUsage () );
	$average = formatSizeUnits ( PeakMemoryUsage::getAverageMemoryUsage () );
	$max = formatSizeUnits ( PeakMemoryUsage::getMaximalUsage () );
	?>

<h2 class="accordion-header"><?php translate("PEAK_MEMORY_USAGE");?></h2>
<div class="accordion-content">
	<table border=0>
		<tr>
			<td><strong><?php translate("MINIMAL");?></strong></td>
			<td style="text-align: right">
<?php echo $min;?>
</td>
		</tr>
		<tr>
			<td><strong><?php translate("AVERAGE");?></strong></td>
			<td style="text-align: right">
<?php echo $average;?>
</td>
		</tr>
		<tr>
			<td><strong><?php translate("MAXIMAL");?></strong></td>
			<td style="text-align: right">
<?php echo $max;?>
</td>
		</tr>
	</table>
</div>
<?php
}
?>