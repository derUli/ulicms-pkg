<!doctype html>
<html lang="<?php echo getCurrentLanguage();
?>">
<head>
<?php base_metas()?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo getTemplateDirPath("dogs");
?>style.css"/>
<meta name="viewport" content="width=1280, initial-scale=1"/>
<style type="text/css">
body{
font-family:<?php echo getconfig("default-font");
?>;
}
</style>
</head>
<body>
<div id="root_container">
<img src="<?php echo getTemplateDirPath("dogs");
?>images/56blnk.jpg" id="header_image">
<div id="nav_top">
<?php menu("top")?>
</div>
<div class="clear"></div>
<div id="nav_left">
<?php if(getconfig("logo_disabled") == "no"){
     logo();
     }else{
     echo "<h1 class='homepage_title'>";
     homepage_title();
     echo "</h1>";
     }
?>
<?php menu("left");
?>
</div>
<div id="content">
<br/>
<?php random_banner();
?>
<h1><?php title()?></h1>