<?php
define ( "MODULE_ADMIN_HEADLINE", "Kalender" );
$required_permission = "fullcalendar_edit";
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", $required_permission );
function fullcalendar_list() {
	$query = db_query ( "SELECT * FROM `" . tbname ( "events" ) . "` ORDER by `start` DESC" );
	
	if (db_num_rows ( $query ) > 0) {
		echo "<table style=\"outline:4px solid #d4d4d4; background-color:#f0f0f0;width:96%; margin:auto;\">";
		echo "<tr style=\"background-color:#f0f0f0;font-weight:bold;\">";
		echo "<td>";
		translate ( "begin" );
		echo "</td>";
		echo "<td>";
		translate ( "end" );
		echo "</td>";
		echo "<td>";
		translate ( "title" );
		echo ":";
		echo "</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
		
		while ( $row = db_fetch_object ( $query ) ) {
			echo "<tr>";
			echo "<td>" . date ( "d.m.Y", $row->start ) . "</strong></td>";
			echo "<td>" . date ( "d.m.Y", $row->end ) . "</strong></td>";
			echo "<td>" . htmlspecialchars ( $row->title ) . "</strong></td>";
			echo "<td><a href=\"?action=module_settings&module=fullcalendar&calendar_action=edit&id=" . $row->id . "\">" . get_translation ( "edit" ) . "</a></td>";
			echo "<td><a href=\"?action=module_settings&module=fullcalendar&calendar_action=delete&id=" . $row->id . "\" onclick=\"return confirm('" . get_Translation ( "ask_for_delete_event" ) . "');\">" . get_translation ( "delete" ) . "</a></td>";
			echo "</tr>";
		}
		
		echo "</table>";
	}
}
function fullcalendar_admin() {
	if (isset ( $_GET ["calendar_action"] ))
		$action = $_GET ["calendar_action"];
	
	if ($action == "delete") {
		$id = intval ( $_GET ["id"] );
		db_query ( "DELETE FROM `" . tbname ( events ) . "` WHERE id = $id" );
		unset ( $action );
	}
	if (isset ( $_POST ["save"] )) {
		
		$title = db_escape ( trim ( $_POST ["title"] ) );
		$url = db_escape ( trim ( $_POST ["url"] ) );
		
		$start = $_POST ["start"];
		$end = $_POST ["end"];
		
		$start = explode ( ".", $start );
		$end = explode ( ".", $end );
		
		if (count ( $start ) === 3) {
			$start [1] = ltrim ( $start [1], "0" );
			$start [0] = ltrim ( $start [0], "0" );
			$start = mktime ( 0, 0, 0, $start [1], $start [0], $start [2] );
		} else {
			$start = time ();
		}
		
		if (count ( $end ) === 3) {
			$end [1] = ltrim ( $end [1], "0" );
			$end [0] = ltrim ( $end [0], "0" );
			$end = mktime ( 0, 0, 0, $end [1], $end [0], $end [2] );
		} else {
			$end = $start;
		}
		
		$id = intval ( $_POST ["id"] );
		
		if ($id == 0) {
			db_query ( "INSERT INTO `" . tbname ( "events" ) . "` (title, url, start, end) VALUES ('$title', '$url', $start, $end)" ) or die ( db_error () );
		} else {
			db_query ( "UPDATE `" . tbname ( "events" ) . "` SET title='$title', url='$url', start='$start', end='$end' WHERE id=$id" );
		}
	}
	?>
<?php

	if (! isset ( $action )) {
		?>
<a
	href="?action=module_settings&module=fullcalendar&calendar_action=add"><?php translate("add_event");?></a>
<br />
<br />
<?php
		
		fullcalendar_list ();
		?>

<?php
	} 

	else if ($action == "add" or $action == "edit") {
		include getModulePath ( "fullcalendar" ) . "fullcalendar_add.php";
	}
}

?>
