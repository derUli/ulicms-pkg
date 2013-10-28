<?php
define("MODULE_ADMIN_HEADLINE", "Einstellungen des Kontaktformulars");

$required_permission = getconfig("kontaktformular_required_permission");

if($required_permission === false){
     $required_permission = 50;
     }

define(MODULE_ADMIN_REQUIRED_PERMISSION, $required_permission);


function kontaktformular_admin(){
    
     if(isset($_POST["submit"])){
     if(empty($_POST["kontaktformular_thankyou_page"]))
        deleteconfig("kontaktformular_thankyou_page");
     else
        setconfig("kontaktformular_thankyou_page", 
        mysql_real_escape_string($_POST["kontaktformular_thankyou_page"]));
      
      }
      


$kontaktformular_thankyou_page = getconfig("kontaktformular_thankyou_page");

$pages = getAllSystemNames();

?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Zielseite:<br/>
<select name="kontaktformular_thankyou_page" size=1>
<option value=""<?php if(!$kontaktformular_thankyou_page) echo " selected=\"selected\""?>>[Standard]</option>
<?php 
for ($i=0; $i < count($pages); $i++) {
$p = htmlspecialchars($pages[$i], ENT_QUOTES, "UTF-8");
?>
<option value="<?php echo $p;?>"<?php if($kontaktformular_thankyou_page == $pages[$i]) echo " selected=\"selected\""?>><?php echo $p;?></option>
<?php }?>
</select>
</p>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>
