<!doctype html>
<html lang="<?php echo getCurrentLanguage(true);?>">
<head>
<?php base_metas()?>
<link rel="stylesheet" type="text/css" href="<?php echo getTemplateDirPath("zwanzigdreizehn");?>style.css"/>
<style type="text/css">
.copyright{
border-color:<?php echo getconfig("body-background-color");?>
}

.header{
background-color:<?php echo getconfig("header-background-color");?>;
}
</style>
</head>
<body>
<div class="root">
<div class="header">
<h1><?php homepage_title()?></h1>
<span><?php motto()?></span>
</div>
<div class="menu">
<?php menu("top");?>
</div>
<div class="container">
<div class="content">
<h2><?php title()?></h2>
