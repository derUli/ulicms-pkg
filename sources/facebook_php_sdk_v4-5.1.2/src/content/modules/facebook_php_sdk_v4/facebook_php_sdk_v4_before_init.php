<?php
function loadFacebookPHPSDK(){
   $path = getModulePath("facebook_php_sdk_v4"). "/Facebook/autoload.php";
   include $path;
}
