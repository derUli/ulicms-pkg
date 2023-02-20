<?php
$page = get_page();
if (isset($page ["lastmodified"]) and $page ["lastmodified"] > 0) {
    ?>
    <div class="last-updated">
        <?php
        translate("last_updated", array(
            "%date%" => PHP81_BC\strftime("%X %x", $page ["lastmodified"])
        ));
        ?>
    </div>
    <?php
}
