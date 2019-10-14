<?php
define("MODULE_ADMIN_HEADLINE", "Platzhalter");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "placeholders");

function placeholders_list()
{
    $query = db_query("SELECT * FROM `" . tbname("placeholders") . "` ORDER by `id` ASC");
    
    if (db_num_rows($query) > 0) {
        echo "<table class=\"tablesorter\">";
		echo "<thead>";
        echo "<tr style=\"background-color:#f0f0f0;font-weight:bold;\">";
        echo "<th>";
        echo "ID";
        echo "</th>";
        echo "<th>";
        echo "Ersetze";
        echo "</th>";
        echo "<th>";
        echo "Durch";
        echo "</th>";
        echo "<th class=\"no-sort\"></th>";
        echo "<th class=\"no-sort\"></th>";
        echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
        
        while ($row = db_fetch_object($query)) {
            echo "<tr>";
            echo "<td>" . $row->id . "</strong></td>";
            echo "<td>" . $row->name . "</strong></td>";
            echo "<td>" . $row->value . "</strong></td>";
            echo "<td><a href=\"?action=module_settings&module=placeholders&placeholders_action=edit&id=" . $row->id . "\">";
			echo '<img src="gfx/edit.png" class="mobile-big-image" alt="Edit" title="Edit">';
			
			echo "</a></td>";
            echo "<td><a href=\"?action=module_settings&module=placeholders&placeholders_action=delete&id=" . $row->id . "\" onclick=\"return confirm('Diesen Platzhalter wirklich löschen?');\">"; 
			echo '<img class="mobile-big-image" src="gfx/delete.gif" alt="'._t("delete").'" title="'._t("delete").'">';
			echo "</a></td>";
            echo "</tr>";
        }
		
		echo "</tbody>";
        
        echo "</table>";
    }
}

function placeholders_admin()
{
    if (isset($_GET["placeholders_action"]))
        $action = $_GET["placeholders_action"];
    
    if ($action == "delete") {
        $id = intval($_GET["id"]);
        db_query("DELETE FROM `" . tbname("placeholders") . "` WHERE id = $id");
        unset($action);
    }
    if (isset($_POST["save"])) {
        
        $name = db_escape(trim($_POST["name"]));
        $value = db_escape(trim($_POST["value"]));
        $match_case = intval(isset($_POST["match_case"]));
        $id = intval($_POST["id"]);
        
        if ($id == 0) {
            db_query("INSERT INTO `" . tbname("placeholders") . "` (name, value, `match_case`) VALUES ('$name', '$value', '$match_case')");
        } else {
            db_query("UPDATE `" . tbname("placeholders") . "` SET name='$name', value='$value', `match_case`='$match_case' WHERE id=$id");
        }
    }
    ?>
<?php
    
    if (! isset($action)) {
        ?>
<a
	href="?action=module_settings&module=placeholders&placeholders_action=add" class="btn btn-default"><i class="fas fa-plus"></i> Platzhalter
	erstellen</a>
<br />
<br />
<?php
        
        placeholders_list();
        ?>

<?php
    } 
    else if ($action == "add" or $action == "edit") {
        include getModulePath("placeholders", true) . "placeholders_add.php";
    }
}

?>
