<?php
define("MODULE_ADMIN_HEADLINE", "Einstellungen von jQuery tablesorter");

$required_permission = getconfig("jquery_tablesorter_required_permission");

if($required_permission === false){
     $required_permission = 50;
     }

define(MODULE_ADMIN_REQUIRED_PERMISSION, $required_permission);


function jquery_tablesorter_admin(){
    
     if(isset($_POST["submit"])){
        setconfig("jquery_tablesorter_theme", 
        db_real_escape_string($_POST["jquery_tablesorter_theme"]));
      }

$jquery_tablesorter_theme = getconfig("jquery_tablesorter_theme");

$themeDir = getModulePath("jquery_tablesorter")."themes/";

$themeDirContent = scandir($themeDir);

$allThemes = array();

for($i = 0; $i < count($themeDirContent); $i++){
   if($themeDirContent[$i] != "." and $themeDirContent[$i] != ".."
   and file_exists($themeDir.$themeDirContent[$i]."/style.css") and is_file($themeDir.$themeDirContent[$i]."/style.css")){
   array_push($allThemes, basename($themeDirContent[$i]));
   }
}

?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Theme<br/>
<select name="jquery_tablesorter_theme" size=1>
<?php 
for($i = 0; $i < count($allThemes); $i++){
?>
<option value="<?php echo $allThemes[$i];?>" <?php if($allThemes[$i] === getconfig("jquery_tablesorter_theme")) echo " selected=\"selected\"";?>>

<?php echo $allThemes[$i];?></option>
<?php }?>
</select>
</p>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>
