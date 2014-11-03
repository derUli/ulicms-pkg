<?php
function kundenbereich_render(){
   if(!is_logged_in()){
      $html = "";
   } else {
      $files = db_query("SELECT id, title, filename FROM `".tbname("shared_files")."` WHERE `user_id` = ".intval($_SESSION["login_id"]). " ORDER by title,filename");
      if(db_num_rows($files) > 0){
      
          $html = "<ul class='shared_files_list'>";
          while($row = db_fetch_object($files)){
          
             $html .= '<li><a href="'.buildSEOUrl().'?get='.$row->id.'">';
             if(is_null($row->title) or empty($row->title)){
                $html .= $row->filename;             
             } else {

                $html .= $row->title;                       
             }
             $html .= "</a></li>";
             
          }
          
          $html .= "</ul>";
      
      } else {
         echo "<span class='shared_file_message ulicms_error'>".
         "Es sind momentan keine Dateien für Sie freigegeben."."</span>";
      }
   }
   
   return $html;
}

