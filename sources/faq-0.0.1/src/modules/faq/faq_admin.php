<?php
define("MODULE_ADMIN_HEADLINE", "FAQ");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "faq_edit");

function faq_admin(){

$action = $_GET["do"];

if(!$action){
   $action = "list";
}

if($action == "list"){

?>

<?php
$sql = db_query("SELECT * FROM ".tbname("faq"). " ORDER by question ASC");
if(db_num_rows($sql) > 0){
?>
<table>
<th>
<td>Frage</td>
<td>Antwort</td>
<td>Bearbeiten</td>
<td>Löschen</td>
</th>
<?php while($row = db_fetch_object($sql)){
echo '<tr>';
echo '<td>'.htmlspecialchars($row->question).'</td>';
echo '<td>'.nl2br(htmlspecialchars($row->answer)).'</td>';
echo '<td>'.'<a href="?action=module_settings&module=faq&action=edit&edit='.$row->id.'"><img src="gfx/edit.gif" alt="Bearbeiten" title="Bearbeiten"></a>'.'</td>';

echo '<td>'.'<a href="?action=module_settings&module=faq&action=delete&delete='.$row->id.'" onclick="return confirm(\'Wirklich löschen?\')"><img src="gfx/delete.gif" alt="Löschen" title="Löschen"></a>'.'</td>';
echo '</tr>';
}?>
</table>

<?php } ?>

<?php 

}

?>

<?php

}
?>