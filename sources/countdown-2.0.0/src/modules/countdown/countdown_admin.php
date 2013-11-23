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
    
     // get current options
    $countdown_to_date = getconfig("countdown_to_date");
    $countdown_width = getconfig("countdown_width");
    $countdown_height = getconfig("countdown_height");
    
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
</table>
<input type="submit" name="submit" value="Einstellungen speichern"/>
</form>



<?php }
?>
