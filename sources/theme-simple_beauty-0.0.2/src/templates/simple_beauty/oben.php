<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php base_metas();
?>
<style type="text/css" rel="stylesheet">
#header, #sub_header{
background-color:<?php echo getconfig("header-background-color");
?>
}
</style>
</head>

<body class="<?php body_classes();?>">

<div id="container">

<div id="header">
<?php
if(getconfig("logo_disabled") == "no"){
     logo();
     }else{
     ?>
<h1><?php homepage_title();
     ?></h1>
<?php }
?>
</div>

<div id="sub_header"><?php motto();
?></div>

<div id="main_content_top"></div>

<div id="main_content">

<div class="content">
