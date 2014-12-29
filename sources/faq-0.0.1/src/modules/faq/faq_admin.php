<?php
define("MODULE_ADMIN_HEADLINE", "FAQ");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "faq_edit");

function faq_admin(){

$action = $_GET["do"];

if(!$action){
   $action = "list";
}

if($action == "delete"){
$delete = intval($_GET["delete"]);

db_query("DELETE FROM " . tbname("faq"). " WHERE id = ".$delete);

$action = "list";
}

if(isset($_POST["create-faq"])){
   $question = db_escape($_POST["question"]);
   $answer = db_escape($_POST["answer"]);
   
   db_query("INSERT INTO ". tbname("faq"). " (question, answer)
   VALUES('$question', '$answer')");
}

if($action == "new"){
?>
<form action="action=module_settings&module=faq&action=list" method="post">
<table>
<tr>
<td>Frage</td>
<td><input type="text" name="question" value="Warum ist die Banane Krum?"></td>
</tr>
<tr>
<td>Antwort</td>
<td><textarea name="answer" cols="50" rows="10">Weil niemand in den Urwald zog, und die Banane gerade bog.</textarea>></td>
</tr>
<tr>
<td>
</td>
<td><input type="submit" name="create-faq" value="create-faq">
</td>
</tr>
</form>
<?
}
if($action == "list"){

?>
<p><strong><a href="?action=module_settings&module=faq&action=new">[Frage erstellen]/a></strong>
</p>
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