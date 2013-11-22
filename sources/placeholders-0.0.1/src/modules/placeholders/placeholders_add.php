<?php
include_once ULICMS_ROOT . DIRECTORY_SEPERATOR . "lib" . DIRECTORY_SEPERATOR . "string_functions.php";
$acl = new ACL();
if($acl -> hasPermission(MODULE_ADMIN_REQUIRED_PERMISSION)){
    
     if(isset($_REQUEST["id"])){
         $placeholder_id = intval($_REQUEST["id"]);
         $query = db_query("SELECT * FROM `" . tbname("placeholders") . "` WHERE id = $placeholder_id");
         $result = db_fetch_object($query);
         $name = $result -> name;
         $value = $result -> value;
         $match_case = $result -> match_case;
         }
    else{
         $name = "";
         $value = "";
         $match_case = 0;
         }
    
     $name = real_htmlspecialchars($name);
     $value = real_htmlspecialchars($value);
     $match_case = intval($match_case);
    
     ?>
<style type="text/css">
form input[type="text"],
textarea{
min-width:200px;
}


</style>
<form action="index.php?action=module_settings&module=placeholders" method="post">
<table>
<tr>
<td>Ersetze</td>
<td><input type="text" name="name" value="<?php echo $name;
     ?>"></td>
</tr>
<tr>
<td>Durch</td>
<td><textarea name="value" rows=5><?php echo $value;
    ?></textarea></td>
</tr>
<tr>
<td>Zwischen Groß- und Kleinschreibung unterscheiden</td>
<td><input type="checkbox" name="match_case" value="1"<?php
     if($match_case)
        echo " checked=\"checked\"";
    ?>></td>
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
