<?php
define("MODULE_ADMIN_HEADLINE", "Countdown");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "countdown");



function countdown_admin(){
    
     // Geänderte Optionen in der Datenbank eintragen
    if(isset($_POST["countdown_to_date"])){
         setconfig("countdown_to_date", strval(strtotime($_POST["countdown_to_date"])));
         }
    
    
    
   
    
     // get current options
    $countdown_to_date = getconfig("countdown_to_date");
    
     ?>
<form method="post" action="<?php echo getModuleAdminSelfPath()?>">
<table style="border:0px">
<tr>
<td><strong>Countdown bis:</strong></td>
<td><input name="countdown_to_date" type="datetime-local" value="<?php
echo date("Y-m-d\TH:i:s", $countdown_to_date);
?>"></td>
</tr>
</table>
<input type="submit" name="submit" value="Einstellungen speichern"/>
</form>



<?php }
?>
