<p>
<?php
$readmeFile = getModulePath("bootstrap") . "readme.txt";
echo nl2br(htmlspecialchars(file_get_contents($readmeFile)));
?>
</p>