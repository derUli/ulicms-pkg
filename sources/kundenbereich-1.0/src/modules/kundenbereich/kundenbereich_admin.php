<?php
define("MODULE_ADMIN_REQUIRED_PERMISSION", "kundenbereich_upload");
define("MODULE_ADMIN_HEADLINE", "Kundenbereich");


function new_file($uid){
echo "<form action=\"index.php?action=module_settings&module=kundenbereich\" method=\"post\" enctype=\"multipart/form-data\">";
    $users = getUsers();
     echo "<p>Kunde<br/>";
     echo "<select name='user'>";
     for($i = 0; $i < count($users); $i++){
         $data = getUserByName($users[$i]);
          echo "<option value=\"".$data["id"]."\">".$data["username"]."</option>";
         }
         
         echo "</select>";
         
         echo "</p>";
         echo "<p>Titel<br/>";
         echo '<input type="text" style=\"width:300px;\" name="titel" value="">';
         echo "</p>";
         
         echo "<p>Datei</br/>";
         echo "<input type=\"file\" name=\"file\">";
         echo "</p>";
         
         echo "<br/><p>";
         echo "<input type=\"submit\" value=\"Hochladen\">";
         echo "</p>";
         
         echo "</form>";
}

function list_files($uid){
if(isset($_REQUEST["delete"])){
   db_query("DELETE FROM `".tbname("shared_files")."` WHERE id=".intval($delete));
}
$files = db_query("SELECT id, title, filename FROM `".tbname("shared_files")."` WHERE `user_id` = ".intval($uid). " ORDER by title,filename");
      if(db_num_rows($files) > 0){
      
          $html = "<ul class='shared_files_list'>";
          while($row = db_fetch_row($files)){
          
             $html .= '<li>';
             if(is_null($title) or empty($title)){
                $html .= $row->filename;             
             } else {

                $html .= $row->title;
                $html .= " <a href=\"index.php?action=module_settings&module=kundenbereich&user=".intval($uid)."&delete=".$row->id."\">[Löschen]</a>";
             }
             $html .= "</li>";
             
          }
          
          $html .= "</ul>";
      
      } else {
         echo "<span class='shared_file_message ulicms_error'>".
         "Es sind momentan keine Dateien für diesen Kunden freigegeben."."</span>";
      }


}

function customer_list(){

    $users = getUsers();
echo "<ol>";
     for($i = 0; $i < count($users); $i++){
         $data = getUserByName($users[$i]);
         echo "<li>" . 
         '<a href="index.php?action=module_settings&module=kundenbereich&user=' . $data["id"] . '">' . $data["username"] . "</a></li>";
         }


}

function kundenbereich_admin(){
if(isset($_REQUEST["user"])){
if(isset($_REQUEST["new"])){
  new_file($_REQUEST["user"]);
} else {
   list_files($_REQUEST["user"]);
}

} else{

  customer_list();
}
    
     }

?>
