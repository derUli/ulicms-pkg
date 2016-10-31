<?php
$acl = new ACL ();
if ($acl->hasPermission ( MODULE_ADMIN_REQUIRED_PERMISSION )) {
	
	if (isset ( $_REQUEST ["id"] )) {
		$event_id = intval ( $_REQUEST ["id"] );
		$query = db_query ( "SELECT * FROM `" . tbname ( "events" ) . "` WHERE id = $event_id" );
		$result = db_fetch_object ( $query );
		$startzeit = date ( "d.m.Y", $result->start );
		$endzeit = date ( "d.m.Y", $result->end );
		$title = $result->title;
		$url = $result->url;
	} else {
		$startzeit = date ( "d.m.Y" );
		$endzeit = date ( "d.m.Y" );
		$title = "Neuer Termin";
		$url = "";
	}
	
	$title = htmlspecialchars ( $title );
	$url = htmlspecialchars ( $url );
	
	?>
<style type="text/css">
form input[type="text"], form input[type="url"] {
	width: 200px;
}

table tr td:first-child {
	width: 80px;
}
</style>
<form action="index.php?action=module_settings&module=fullcalendar"
	method="post">
<?php
	
	csrf_token_html ();
	?>
<table>
		<tr>
			<td><?php translate("begin");?></td>
			<td><input type="text" name="start"
				value="<?php
	
	echo $startzeit;
	?>"></td>
		</tr>
		<tr>
			<td><?php translate("end");?></td>
			<td><input type="text" name="end" value="<?php
	
	echo $endzeit;
	?>"></td>
		</tr>
		<tr>
			<td><?php translate("title");?>:</td>
			<td><input type="text" name="title" value="<?php
	
	echo $title;
	?>"></td>
		</tr>
		<tr>
			<td><?php translate("url");?></td>
			<td><input type="url" name="url" value="<?php
	
	echo $url;
	?>"></td>
		</tr>
		<tr>
			<td></td>
			<td align="center">
<?php
	
	if (isset ( $event_id )) {
		?>
<input type="hidden" name="id" value="<?php
		
		echo $event_id;
		?>">
<?php
	}
	?>
<input type="submit" name="save" value="<?php translate("save");?>" />
			</td>
		</tr>
	</table>

</form>

<?php
}
?>
