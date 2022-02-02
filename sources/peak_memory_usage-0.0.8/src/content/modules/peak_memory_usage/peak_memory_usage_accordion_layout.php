<?php
use UliCMS\Helpers\NumberFormatHelper;

include_once getModulePath("peak_memory_usage", true) . "/objects/peak_memory_usage.php";

$acl = new ACL();
if ($acl->hasPermission("peak_memory_usage")) {
    $min = NumberFormatHelper::formatSizeUnits(PeakMemoryUsage::getMinimalUsage());
    $average = NumberFormatHelper::formatSizeUnits(PeakMemoryUsage::getAverageMemoryUsage());
    $max = NumberFormatHelper::formatSizeUnits(PeakMemoryUsage::getMaximalUsage()); ?>

<h2 class="accordion-header"><?php translate("PEAK_MEMORY_USAGE"); ?></h2>
<div class="accordion-content">
	<table>
		<tr>
			<td><strong><?php translate("MINIMAL"); ?></strong></td>
			<td style="text-align: right">
<?php echo $min; ?>
</td>
		</tr>
		<tr>
			<td><strong><?php translate("AVERAGE"); ?></strong></td>
			<td style="text-align: right">
<?php echo $average; ?>
</td>
		</tr>
		<tr>
			<td><strong><?php translate("MAXIMAL"); ?></strong></td>
			<td style="text-align: right">
<?php echo $max; ?>
</td>
		</tr>
	</table>
</div>
<?php
}
?>