<?php
function seo_title_tag_title_filter($title){
      $custom_data = get_custom_data();
      if(isset($custom_data["seo_title"]) and 
        !empty($custom_data["seo_title"])){
          $title = str_replace("%seo_title%", $custom_data["seo_title"], $title);
      } else {
          $title = str_replace("%seo_title%", get_title(), $title);
      }
      
      return $title;
}