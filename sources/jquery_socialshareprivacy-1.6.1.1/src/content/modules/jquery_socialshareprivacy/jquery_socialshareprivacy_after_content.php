<?php
$data = get_custom_data();
if (! isset($data ["disable_socialshare"]) and ! isset($data ["disable_facebook_like"]) and ! isset($data ["disable_google_plusone"]) and is_200()) {
    ?>

<div class="socialshareprivacy"></div>
<?php
}
?>
