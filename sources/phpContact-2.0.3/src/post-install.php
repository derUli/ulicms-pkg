<?php
$liesmich = getModulePath("phpContact")."/liesmich.txt";
$liesmich = file_get_contents($liesmich);
$liesmich = htmlspecialchars($liesmich);
$liesmich = nl2br($liesmich);
echo "<pre>".$liesmich."</pre>";
