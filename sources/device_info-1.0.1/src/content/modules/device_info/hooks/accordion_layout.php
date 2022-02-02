<?php
$acl = new ACL();
if ($acl->hasPermission("device_info")) {
    $query = Database::query("SELECT * from {prefix}device_infos", true);
    $result = Database::fetchObject($query); ?>

<h2 class="accordion-header"><?php translate("statistics_by_device"); ?></h2>
<div class="accordion-content">
	<table style="">
		<tr>
			<td><strong><?php translate("pc"); ?></strong></td>
			<td style="text-align: right;"><?php echo $result->pc; ?></td>
		</tr>
		<td><strong><?php translate("tablets"); ?></strong></td>
		<td style="text-align: right;"><?php echo $result->tablet; ?></td>
		</tr>
		<td><strong><?php translate("other_mobiles"); ?></strong></td>
		<td style="text-align: right;"><?php echo $result->mobile; ?></td>
		</tr>
		<td><strong><?php translate("crawler"); ?></strong></td>
		<td style="text-align: right;"><?php echo $result->crawler; ?></td>
		</tr>

	</table>
</div>


<?php
}
?>
