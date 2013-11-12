<?php






function blog_render(){

     $acl = new ACL();
    

     // Prüfen, ob Blog schon installiert

    blog_check_installation();

    

    

     if(!empty($_GET["single"])){

         require_once getModulePath("blog") . "blog_single.php";

         return blog_single(db_escape($_GET["single"]));

         }

    else if(!empty($_GET["blog_admin"])){

         if($_GET["blog_admin"] == "add"){

             require_once getModulePath("blog") . "blog_add.php";

             return blog_add_form();

             }

        else if($_GET["blog_admin"] == "edit_post"){

             require_once getModulePath("blog") . "blog_edit.php";

             return blog_edit_form(intval($_GET["id"]));

             }

        else if($_GET["blog_admin"] == "submit"){

             return blog_submit();

            

             }

        else if($_GET["blog_admin"] == "update"){

             return blog_update();

             }

        else if($_GET["blog_admin"] == "delete_post"){

             require_once getModulePath("blog") . "blog_remove.php";

             return blog_remove_post(intval($_GET["id"]));

             }else if($_GET["blog_admin"] == "delete_comment"){

             require_once getModulePath("blog") . "blog_remove.php";

             return blog_remove_comment(intval($_GET["id"]));

             }

         }

    

    

    else{

         require_once getModulePath("blog") . "blog_list.php";

         return blog_list();

         }

    

     }









function blog_update(){
     $acl = new ACL();
     include_once "spellcheck.php";
     $html_output = "";
     $doSpellCheck = isset($_POST["spellcheck"]);

    

     $title = $_POST["title"];

     if($doSpellCheck)

         $title = autocorrect_common_typos($title);

    

     $title = db_escape($title);

    

     $seo_shortname = db_escape($_POST["seo_shortname"]);

    

     if(empty($title) or empty($seo_shortname)){

         $html_output .= "<script type='text/javascript'>

     history.back()     

     </script>";

         return $html_output;

        

        

         }

    

     $language = db_escape($_POST["language"]);

     $comments_enabled = db_escape($_POST["comments_enabled"]);

     $entry_enabled = db_escape($_POST["entry_enabled"]);

    

     $content_full = $_POST["content_full"];

     $content_preview = $_POST["content_preview"];

    

     if($doSpellCheck){

         $content_full = autocorrect_common_typos($content_full);

         $content_preview = autocorrect_common_typos($content_preview);

        

         }

    

    

     $content_full = db_escape($content_full);

     $content_preview = db_escape($content_preview);

    

    

     $date = time();

     $author = $_SESSION["login_id"];

    

     $id = intval($_POST["id"]);

    

     $datum = strtotime($_POST["datum"]);

    

     if($datum === false){

         $datum = "datum";

         }

         

    

     // Rechte prüfen

    if($acl->hasPermission("blog")){

         $insert_query = "UPDATE `" . tbname("blog") . "` SET title = '$title',

	 seo_shortname = '$seo_shortname', comments_enabled = $comments_enabled,

	 entry_enabled = $entry_enabled, language = '$language', content_full = '$content_full',

	 datum = $datum,

	 content_preview = '$content_preview' WHERE id = $id

	 ";

         db_query($insert_query);

         $html_output .= "<script type='text/javascript'>

  location.replace('" . get_requested_pagename() .

         ".html?single=" . $seo_shortname . "');

  </script>

  ";

        

        

         }

    

    

     return $html_output;

     }







function blog_submit(){

     $acl = new ACL();
    

     include_once "spellcheck.php";

    

     $html_output = "";

    

     $doSpellCheck = isset($_POST["spellcheck"]);

    

     $title = $_POST["title"];

     if($doSpellCheck)

         $title = autocorrect_common_typos($title);

    

     $title = db_escape($title);

    

     $seo_shortname = db_escape($_POST["seo_shortname"]);

    

     if(empty($title) or empty($seo_shortname)){

         $html_output .= "<script type='text/javascript'>

     history.back()     

     </script>";

         return $html_output;

        

        

         }

    

     $language = db_escape($_POST["language"]);

     $comments_enabled = db_escape($_POST["comments_enabled"]);

     $entry_enabled = db_escape($_POST["entry_enabled"]);

    

     $content_full = $_POST["content_full"];

     $content_preview = $_POST["content_preview"];

     if($doSpellCheck){

         $content_full = autocorrect_common_typos($content_full);

         $content_preview = autocorrect_common_typos($content_preview);

        

         }

    

    

     $content_full = db_escape($content_full);

     $content_preview = db_escape($content_preview);

    

     $author = $_SESSION["login_id"];

     $datum = strtotime($_POST["datum"]);

    

     if($datum === false){

         $datum = time();

         }

    

     // Rechte prüfen

    if($acl->hasPermission("blog")){

         $insert_query = "INSERT INTO `" . tbname("blog") . "` (datum, " .

         "title, seo_shortname, comments_enabled, language, 

  entry_enabled, author, 

  content_full, content_preview) VALUES ($datum, '$title', 

  '$seo_shortname', $comments_enabled, '$language', $entry_enabled,

  $author, '$content_full', '$content_preview')";

        

         db_query($insert_query);

        

         $html_output .= "<script type='text/javascript'>

  location.replace('" . get_requested_pagename() .

         ".html?single=" . $seo_shortname . "');

  </script>

  ";

        

         }

    

    

     return $html_output;

     }







function blog_check_installation(){

     $test = db_query("SELECT * FROM " . tbname("blog"));

     if(!$test){

         require_once getModulePath("blog") . "blog_install.php";

         blog_do_install();

         }else{

         $fetch = db_fetch_assoc($test);

         if(!isset($fetch["views"])){

             db_query("ALTER TABLE `" . tbname("blog") . "` ADD views int DEFAULT 0");

             }

         }

    

     }















?>