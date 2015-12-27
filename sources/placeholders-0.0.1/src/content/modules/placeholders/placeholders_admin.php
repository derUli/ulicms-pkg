<?php
define ( "MODULE_ADMIN_HEADLINE", "Platzhalter" );
$required_permission = "placeholders";
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", $required_permission );
function placeholders_list() {
	$query = db_query ( "SELECT * FROM `" . tbname ( "placeholders" ) . "` ORDER by `id` ASC" );
	
	if (db_num_rows ( $query ) > 0) {
		echo "<table style=\"outline:4px solid #d4d4d4; background-color:#f0f0f0;width:96%; margin:auto;\">";
		echo "<tr style=\"background-color:#f0f0f0;font-weight:bold;\">";
		echo "<td>";
		echo "ID";
		echo "</td>";
		echo "<td>";
		echo "Ersetze";
		echo "</td>";
		echo "<td>";
		echo "Durch";
		echo "</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
		
		while ( $row = db_fetch_object ( $query ) ) {
			echo "<tr>";
			echo "<td>" . $row->id . "</strong></td>";
			echo "<td>" . $row->name . "</strong></td>";
			echo "<td>" . $row->value . "</strong></td>";
			echo "<td><a href=\"?action=module_settings&module=placeholders&placeholders_action=edit&id=" . $row->id . "\">Bearbeiten</a></td>";
			echo "<td><a href=\"?action=module_settings&module=placeholders&placeholders_action=delete&id=" . $row->id . "\" onclick=\"return confirm('Diesen Platzhalter wirklich löschen?');\">Löschen</a></td>";
			echo "</tr>";
		}
		
		echo "</table>";
	}
}
function placeholders_admin() {
	if (isset ( $_GET ["placeholders_action"] ))
		$action = $_GET ["placeholders_action"];
	
	if ($action == "delete") {
		$id = intval ( $_GET ["id"] );
		db_query ( "DELETE FROM `" . tbname ( "placeholders" ) . "` WHERE id = $id" );
		unset ( $action );
	}
	if (isset ( $_POST ["save"] )) {
		
		$name = db_escape ( trim ( $_POST ["name"] ) );
		$value = db_escape ( trim ( $_POST ["value"] ) );
		$match_case = intval ( isset ( $_POST ["match_case"] ) );
		$id = intval ( $_POST ["id"] );
		
		if ($id == 0) {
			db_query ( "INSERT INTO `" . tbname ( "placeholders" ) . "` (name, value, `match_case`) VALUES ('$name', '$value', '$match_case')" );
		} else {
			db_query ( "UPDATE `" . tbname ( "placeholders" ) . "` SET name='$name', value='$value', `match_case`='$match_case' WHERE id=$id" );
		}
	}
	?>
<?php

	
if (! isset ( $action )) {
		?>
<a
	href="?action=module_settings&module=placeholders&placeholders_action=add">Platzhalter
	erstellen</a>
<br />
<br />
<?php
		
placeholders_list ();
		?>

<?php
	
} 

	else if ($action == "add" or $action == "edit") {
		include getModulePath ( "placeholders" ) . "placeholders_add.php";
	}
}

?>
