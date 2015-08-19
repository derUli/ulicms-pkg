<?php
function seo_title_tag_title_filter($title){
      $custom_data = get_custom_data();
      if(isset($custom_data["seo_title"]) and 
        !empty($custom_data["seo_title"])){
          $title = str_ireplace("%seo_title%", $custom_data["seo_title"], $title);
      } else {
          $page = get_page();
          $page_title = $page["title"];
          $title = str_ireplace("%seo_title%", $page_title, $title);
      }
      
      return $title;
}