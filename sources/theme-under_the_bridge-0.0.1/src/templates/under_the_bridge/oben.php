<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php base_metas();
?>
<link rel="stylesheet" type="text/css" href="<?php echo getTemplateDirPath("under_the_bridge")?>style.css" />
</head>

<body>

<div id="container">

<div id="header">
<h1><?php homepage_title();
?></h1>
<h2><?php motto();
?></h2>
</div>


<div id="linkbar">
<div id="navcontainer">
<?php
language_selection();
?>
</div>
</div>



<div id="content">

<div id="right_menu">
<h4>Navigation</h4>

<div class="navcontainer">
<?php menu("right");
?>
</div>
</div>

