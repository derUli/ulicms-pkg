<?php
$data_here = false;
foreach ( explode ( ",", $_REQUEST ["sites"] ) as $id ) {
	$nid = intval ( $id );
	$site = Sites::getSiteByID ( $nid );
	$site = Database::fetchAssoc ( $site );
	$con = new uManageConnection ( $site ["api_key"], $site ["url"] );
	$result = $con->checkForPatches ();
	if ($result and count ( $result ["patches"] ) > 0) {
		$data_here = true;
		break;
	}
}
?>

<h1><?php translate("check_for_patches");?></h1>
<?php if($data_here){?>
<form action="index.php?action=umanage_install_patches" method="post"
	id="patch-list-form">
	<?php csrf_token_html();?>
	<p>
		<input id="checkall" type="checkbox" class="checkall" checked> <label
			for="checkall"><?php
	
	translate ( "select_all" );
	?> </label>
	</p>
	<table class="tablesorter">
		<thead>
			<td></td>
			<th><?php translate("domain");?></th>
			<th><?php translate("patch");?></th>
			<th><?php translate("description");?></th>
		</thead>
		<tbody>
<?php
	foreach ( explode ( ",", $_REQUEST ["sites"] ) as $id ) {
		$nid = intval ( $id );
		$site = Sites::getSiteByID ( $nid );
		$site = Database::fetchAssoc ( $site );
		$con = new uManageConnection ( $site ["api_key"], $site ["url"] );
		$result = $con->checkForPatches ();
		if ($result and isset ( $result ["patches"] )) {
			$patches = $result ["patches"];
			?>
			<?php foreach($patches as $patch){?>
<tr>
				<td><input type="checkbox" name="patches[]" class="patch-checkbox"
					value="<?php Template::escape($site["id"]);?>/<?php Template::escape($patch[0]);?>"
					checked></td>
				<td><?php Template::escape($site["domain"]);?></td>
				<td><?php Template::escape($patch[0]);?></td>
				<td><?php Template::escape($patch[1]);?></td>
			</tr>
			<?php }?>
				<?php
		}
	}
	?>
		</tbody>
	</table>
	<p>
		<input type="submit" value="<?php translate("install_patches");?>">
	</p>
</form>
<?php
} else {
	?>
<p><?php translate("NO_PATCHES_AVAILABLE");?></p>
<?php }?>
<p>
	<a href="index.php?action=umanage_list"><?php translate("back")?></a>
</p>

<script type="text/javascript"
	src="<?php echo getModulePath("umanage_client")?>scripts/patches.js"></script>
