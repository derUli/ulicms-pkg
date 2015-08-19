<?php
function seo_title_tag_title_tag_filter($title){
      $custom_data = get_custom_data();
      if(isset($custom_data["seo_title"]) and 
        !empty($custom_data["seo_title"])){
          $title = str_ireplace("%seo_title%", $custom_data["seo_title"], $title);
      }
      
      return $title;
}