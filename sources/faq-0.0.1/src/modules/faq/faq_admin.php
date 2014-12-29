<?php
define("MODULE_ADMIN_HEADLINE", "FAQ");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "faq_edit");

function faq_admin(){

?>
<style type="text/css">

table th{
text-align:left;
}

input[type="text"], textarea{
width:300px;
}
</style>
<?php

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

if(isset($_POST["edit-faq"])){
  $id = intval($_POST["edit-faq"]);
   $question = db_escape($_POST["question"]);
   $answer = db_escape($_POST["answer"]);
   db_query("UPDATE ". tbname("faq"). " SET question='$question',
   answer='$answer' WHERE id = $id");
}

if($action == "new"){
?>
<form action="action=module_settings&module=faq&do=list" method="post">
<table>
<tr>
<td style="width:150px">Frage</td>
<td><input type="text" name="question" size="50" maxlength="255" value="Warum ist die Banane Krum?"></td>
</tr>
<tr>
<td style="width:150px">Antwort</td>
<td><textarea name="answer" cols="50" rows="10">Weil niemand in den Urwald zog, und die Banane gerade bog.</textarea></td>
</tr>
<tr>
<td>
</td>
<td style="text-align:center"><input type="hidden" name="create-faq" value="create-faq">
<p><input type="submit" value="Frage Erstellen"></p>
</td>
</tr>
</table>
</form>
<?
}

if($action == "edit"){
$edit = intval($_GET["edit"]);
$sql = db_query("SELECT * FROM ".tbname("faq"). " where id = $edit ORDER by question ASC");
$data = db_fetch_object($sql);
?>
<form action="action=module_settings&module=faq&do=list" method="post">
<table>
<tr>
<td style="width:150px">Frage</td>
<td><input type="text" size="50" maxlength="255" name="question" value="<?php echo htmspecialchars($data->question, ENT_QUOTES, "utf-8");?>"></td>
</tr>
<tr>
<td style="width:150px">Antwort</td>
<td><textarea name="answer" cols="50" rows="10"><?php echo nl2br(htmspecialchars($data->answer));?></textarea>></td>
</tr>
<tr>
<td>
</td>
<td style="text-align:center"><input type="hidden" name="edit-faq" value="<?php echo $data->id;?>">
<p>
<input type="submit" value="Frage Speichern"></p>
</td>
</tr>
</table>
</form>

<?php

}

if($action == "list"){

?>
<p><strong><a href="?action=module_settings&module=faq&do=new">[Frage erstellen]</a></strong>
</p>
<?php
$sql = db_query("SELECT * FROM ".tbname("faq"). " ORDER by question ASC");
if(db_num_rows($sql) > 0){
?>
<table style="width:100%">
<tr>
<th>Frage</th>
<th>Antwort</th>
<th></th>
<th></th>
</tr>
<?php while($row = db_fetch_object($sql)){
echo '<tr>';
echo '<td>'.htmlspecialchars($row->question).'</td>';
echo '<td>'.nl2br(htmlspecialchars($row->answer), 60).'</td>';
echo '<td style="text-align:center">'.'<a href="?action=module_settings&module=faq&do=edit&edit='.$row->id.'"><img src="gfx/edit.gif" alt="Bearbeiten" title="Bearbeiten"></a>'.'</td>';

echo '<td style="text-align:center">'.'<a href="?action=module_settings&module=faq&do=delete&delete='.$row->id.'" onclick="return confirm(\'Wirklich löschen?\')"><img src="gfx/delete.gif" alt="Löschen" title="Löschen"></a>'.'</td>';
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