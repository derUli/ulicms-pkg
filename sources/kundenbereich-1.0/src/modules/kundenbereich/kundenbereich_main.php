<?php
function kundenbereich_render(){
   if(!is_logged_in()){
      $html = "";
   } else {
      $files = db_query("SELECT id, title, filename FROM `".tbname("shared_files")."` WHERE `user_id` = ".intval($_SESSION["login_id"]));
      if(db_num_rows($files) > 0){
      
          $html = "<ul class='shared_files_list'>";
          while($row = db_fetch_row($files)){
          
             $html .= '<li><a href="'.getCurrentURL().'&get='.$row->id.'">';
             if(is_null($title) or empty($title)){
                $html .= $row->filename;             
             } else {

                $html .= $row->title;                       
             }
             $html .= "</a></li>";
             
          }
          
          $html .= "</ul>";
      
      }
   }
   
   return $html;
}

