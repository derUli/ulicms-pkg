<?php
$acl = new ACL();
if($acl->hasPermission(MODULE_ADMIN_REQUIRED_PERMISSION)){
    
     if(isset($_REQUEST["id"])){
         $placeholder_id = intval($_REQUEST["id"]);
         $query = db_query("SELECT * FROM `" . tbname("placeholders") . "` WHERE id = $placeholder_id");
         $result = db_fetch_object($query);
         $name = $result->name;
         $value = $result -> value;
         }
    else{
         $name = "";
         $value = "";
         }
    
     $name = htmlspecialchars($name);
     $value = htmlspecialchars($value);
    
     ?>
<style type="text/css">
form input[type="text"],
form input[type="url"]{
width:200px;
}

table tr td:first-child{
width:80px;
}
</style>
<form action="index.php?action=module_settings&module=placeholders" method="post">
<table>
<tr>
<td>Ersetze:</td>
<td><input type="text" name="name" value="<?php echo $name;
     ?>"></td>
</tr>
<tr>
<td>Durch:</td>
<td><input type="text" name="value" value="<?php echo $value;
     ?>"></td>
</tr>
<tr>
<td>
</td>
<td align="center">
<?php if(isset($placeholder_id)){
         ?>
<input type="hidden" name="id" value="<?php echo $placeholder_id;
         ?>">
<?php
         }
     ?>
<input type="submit" name="save" value="Eintragen"/></td>
</tr>
</table>

</form>

<?php }
?>
