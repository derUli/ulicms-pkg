<?php
$data = get_custom_data();
$language = getCurrentLanguage();
if ($language != "de") {
    $language = "en";
}
;
if (!isset($data ["disable_socialshare"]) &&
        !isset($data ["disable_facebook_like"]) &&
        !isset($data ["disable_google_plusone"]) &&
        is_200()) {
    ?>
    <script type="text/javascript"
    src="<?php echo getModulePath("shariff"); ?>shariff.complete.js"></script><?php
}