<?php
$sites = Sites::getAllSites ();
?>
<h1><?php translate("list_of_remote_sites")?></h1>

<p>
	<a href="index.php?action=umanage_new"><?php translate("add_site");?></a>
</p>

<?php if(count($sites) > 0){?>

<form action="#" method="get" id="list-form">
<?php csrf_token_html();?>
<p>
		<strong><?php translate("action")?></strong><br /> <select
			name="action" size=1>
			<option value="umanage_list">[<?php translate("please_select");?>]</option>
			<option value="umanage_check_for_patches"><?php translate("check_for_patches");?></option>
			<option value="check_for_package_updates"><?php translate("check_for_package_updates");?></option>
			<option value="umanage_clear_log"><?php translate("clear_log");?></option>
		</select>

	</p>
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
			<th><?php translate("ulicms_version");?></th>
			<th><?php translate("client_version");?></th>
			<td style="font-weight: bold; text-align: center;"><?php translate("edit")?></td>
			<td style="font-weight: bold; text-align: center;"><?php translate("delete")?></td>
		</thead>
		<tbody>
	<?php
	
	while ( $site = Database::fetchAssoc ( $sites ) ) {
		$ulicms_version = get_translation ( "unknown" );
		$client_version = get_translation ( "unknown" );
		$ulicms_version_color = "inherit";
		$con = new uManageConnection ( $site ["api_key"], $site ["url"] );
		$info = $con->getInfo ();
		$char = " ";
		if ($info) {
			if ($info ["version"]) {
				$ulicms_version = $info ["version"];
			}
			if ($info ["umanage_server_version"]) {
				$client_version = $info ["umanage_server_version"];
			}
			if ($info ["is_core_current"]) {
				$ulicms_version_color = "green";
				$char = " ✓";
			} else {
				$ulicms_version_color = "red";
				$char = " ×";
			}
		}
		?>
		<tr>
				<td><input type="checkbox" name="sites"
					id="site-<?php echo $site["id"];?>"
					value="<?php echo $site["id"];?>" checked class="site-checkbox"></td>
				<td><a href="<?php Template::escape($site["url"]);?>"
					target="_blank"><?php Template::escape($site["domain"]);?></a></td>
				<td><span  style="color: <?php echo $ulicms_version_color;?>"><?php Template::escape($ulicms_version); echo $char;?></span></td>
				<td><?php Template::escape($client_version);?></td>
				<td style="text-align: center;"><a
					href="index.php?action=umanage_edit&id=<?php echo $site["id"];?>"><img
						src="gfx/edit.png" alt="<?php translate("edit")?>"
						title="<?php translate("edit")?>"></a></td>
				<td style="text-align: center;"><a
					href="index.php?action=module_settings&module=umanage_client&form_action=delete_site&id=<?php echo $site["id"];?>"><img
						src="gfx/delete.png" alt="<?php translate("delete");?>"
						title="<?php translate("delete");?>"
						nclick="return confirm('<?php translate("ask_for_delete");?>');"></a></td>

				</td>
			</tr>
	<?php }?>
	</tbody>
	</table>
	<p>
		<input type="submit" value="<?php translate("execute_action");?>">
	</p>
</form>

<?php }?>
<script type="text/javascript"
	src="<?php echo getModulePath("umanage_client")?>scripts/list.js"></script>
