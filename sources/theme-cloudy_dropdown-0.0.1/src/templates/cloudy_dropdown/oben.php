<!doctype html>
<html lang="<?php echo getCurrentLanguage();
?>">
<head>
<?php base_metas()?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo getTemplateDirPath("cloudy_dropdown");
?>style.css"/>
</head>
<body>
	<div class="root-container">
		<div class="logo">
<?php
if(getconfig("logo_disabled") == "no")
    {
     logo();
     ?>
<br/>  
<?php
     }
else{
     ?><h1><?php homepage_title()?></h1>
<?php }
?>
<p><strong><?php motto()?></strong></div>
<?php menu("top"); ?>

<div class="content">