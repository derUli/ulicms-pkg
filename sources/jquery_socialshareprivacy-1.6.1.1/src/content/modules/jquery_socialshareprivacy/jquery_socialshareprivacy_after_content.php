<?php
$data = get_custom_data();
if (
        !isset($data ["disable_socialshare"]) &&
        !isset($data ["disable_facebook_like"]) &&
        !isset($data ["disable_google_plusone"]) &&
        is_200()
) {
    ?>

    <div class="socialshareprivacy"></div>
    <?php
}
