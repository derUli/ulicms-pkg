<?php
define("MODULE_ADMIN_HEADLINE", "unews");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "unews");

function unews_admin_url($section = "dashboard"){
   return "?action=module_settings&module=unews&section=".$section;
}

function unews_admin(){
    $section = $_GET["section"];

if($section == "articles_list"){
   include_once getModulePath("unews")."articles_list.php";
} else{
  include_once getModulePath("unews")."unews_dashboard.php";
}
?>


<?php
     }

?>
