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
         if($data["id"] == $uid){
            
             echo "<option value=\"" . $data["id"] . "\" selected=\"selected\">" . $data["username"] . "</option>";
             }
        else{
             echo "<option value=\"" . $data["id"] . "\">" . $data["username"] . "</option>";
             }
        
         }
    
     echo "</select>";
    
     echo "</p>";
     echo "<p>Titel<br/>";
     echo '<input type="text" style=\"width:300px;\" name="title" value="">';
     echo "</p>";
    
     echo "<p>Datei</br/>";
     echo "<input type=\"file\" name=\"file\">";
     echo "</p>";
    
     echo "<br/><p>";
     echo "<input type=\"submit\" value=\"Hochladen\">";
     echo "</p>";
    
     echo "</form>";
     }

function do_upload(){
     if(!empty($_FILES['file']['name'])){
        
         @set_time_limit(0); // Kein Zeitlimit;
         $filename = db_escape($_FILES['file']['name']);
         $content = file_get_contents($_FILES['file']["tmp_name"]);
         $content = base64_encode($content);
         $content = db_escape($content);
         $title = db_escape($_POST["title"]);
         $user_id = intval($_POST["user"]);
         $sql = "INSERT INTO `" . tbname("shared_files") . "` (`title`, `filename`, `user_id`, `content`) VALUES ('$title', '$filename', $user_id, '$content');";
         db_query($sql);
        
         }
    
     }

function list_files($uid){
    
     echo "<p><a href=\"index.php?action=module_settings&module=kundenbereich&new&user=" . intval($uid) . "\">[Datei hochladen]</a></p>";
    
     if(isset($_REQUEST["delete"])){
        
         db_query("DELETE FROM `" . tbname("shared_files") . "` WHERE id=" . intval($_REQUEST["delete"]));
         }
     $files = db_query("SELECT id, title, filename FROM `" . tbname("shared_files") . "` WHERE `user_id` = " . intval($uid) . " ORDER by id");
     if(db_num_rows($files) > 0){
        
         $html = "<ol class='shared_files_list'>";
        
         while($row = db_fetch_object($files)){
             $html .= '<li>';
             if(is_null($row -> title) or empty($row -> title)){
                
                 $html .= $row -> filename;
                 }else{
                
                 $html .= $row -> title;
                 }
             $html .= " <a href=\"index.php?action=module_settings&module=kundenbereich&user=" . intval($uid) . "&delete=" . $row -> id . "\" onclick=\"return confirm('Wirklich löschen?');\">[Löschen]</a>";
            
             $html .= "</li>";
            
             }
        
         $html .= "</ol>";
        
         echo $html;
        
         }else{
         echo "<p class='shared_file_message ulicms_error'>" .
         "Es sind momentan keine Dateien für diesen Kunden freigegeben." . "</p>";
         }
    
    
     echo "<p><a href=\"?action=module_settings&module=kundenbereich\">[Zurück zur Kundenliste]</a></p>";
    
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
         if(!empty($_FILES['file']['name'])){
             do_upload();
             list_files($_REQUEST["user"]);
             }
        else if(isset($_REQUEST["new"])){
             new_file($_REQUEST["user"]);
             }else{
             list_files($_REQUEST["user"]);
             }
        
         }else{
        
         customer_list();
         }
    
     }

?>
