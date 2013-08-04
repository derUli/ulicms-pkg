<!doctype html>
<html lang="<?php echo getCurrentLanguage();?>">
<head>
<?php base_metas()?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo getTemplateDirPath("default");?>style.css"/>
<?php 
if(!getconfig("header-background-color")){
   setconfig("header-background-color", "rgb(35, 148, 96)");
}

if(!getconfig("body-background-color")){
   setconfig("body-background-color", "rgb(255,255,255)");
}


if(!getconfig("body-text-color")){
   setconfig("body-text-color", "rgb(0,0,0)");
}


?>
<style type="text/css">
.header{
background-color:<?php echo getconfig("header-background-color");?>;
}
</style>
</head>
<body>
<div class="header">
<div class="logo">
<?php
if(getconfig("logo_disabled")=="no")
{
  logo();
?>
<br/>  
<?php
}
else{
?><h1><?php homepage_title()?></h1>
<?php }?>
<span><?php motto()?></span>
</div>
<div class="navbar_top">
<?php menu("top")?>
</div>
</div>
<div class="clear"></div>
<div class="container">
<div id="language_box"><?php language_selection()?>
</div>
<br/>
<hr>
<div class="content">