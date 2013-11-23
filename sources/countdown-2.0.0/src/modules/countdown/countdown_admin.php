<?php
define("MODULE_ADMIN_HEADLINE", "Countdown");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "countdown");



function countdown_admin(){
    
     // Geänderte Optionen in der Datenbank eintragen
    if(isset($_POST["countdown_to_date"])){
         setconfig("countdown_to_date", strval(strtotime($_POST["countdown_to_date"])));
         }
    
    
    if(isset($_POST["countdown_width"]))
	   setconfig("countdown_width", intval($_POST["countdown_width"]));
    
   
    if(isset($_POST["countdown_height"]))
	   setconfig("countdown_height", intval($_POST["countdown_height"]));
    
	if(isset($_POST["countdown_style"]))
	   setconfig("countdown_style", db_escape($_POST["countdown_style"]));
	   
	if(isset($_POST["countdown_target"]))
	   setconfig("countdown_target", db_escape($_POST["countdown_target"]));
    
     // get current options
    $countdown_to_date = getconfig("countdown_to_date");
    $countdown_width = getconfig("countdown_width");
    $countdown_height = getconfig("countdown_height");
	$countdown_style = getconfig("countdown_style");
	$countdown_target = getconfig("countdown_target");
	$countdown_oncomplete = getconfig("countdown_oncomplete");
    
     ?>
<form method="post" action="<?php echo getModuleAdminSelfPath()?>">
<table style="border:0px">
<tr>
<td><strong>Countdown bis</strong></td>
<td><input name="countdown_to_date" type="datetime-local" value="<?php
echo date("Y-m-d\TH:i:s", $countdown_to_date);
?>"></td>
</tr>
<tr>
<td><strong>Breite</strong></td>
<td><input name="countdown_width" type="number" step="any" value="<?php
     echo $countdown_width;
     ?>" min="1"></td>
</tr>
<tr>
<td><strong>Höhe</strong></td>
<td><input name="countdown_height" type="number" step="any" value="<?php
     echo $countdown_height;
     ?>" min="1"></td>
</tr>
<tr>
<td><strong>Zielelement</strong></td>
<td><input type="text" name="countdown_target" value="<?php echo stringHelper::real_htmlspecialchars($countdown_target)?>"> </td>
</tr>
<tr>
<td><strong>onComplete Funktion</strong></td>
<td><input type="text" name="countdown_oncomplete" value="<?php echo stringHelper::real_htmlspecialchars($countdown_oncomplete)?>"> </td>
</tr>
<tr>
<td><strong>Style</strong></td>
<td><select name="countdown_style">
<option value="boring" <?php if($countdown_style == "boring")
 echo "selected";
 ?>>boring</option>
<option value="flip" <?php if($countdown_style == "flip")
 echo "selected";
 ?>>flip</option>
</select></td>
</tr>
</table>
<input type="submit" name="submit" value="Einstellungen speichern"/>
</form>



<?php }
?>
