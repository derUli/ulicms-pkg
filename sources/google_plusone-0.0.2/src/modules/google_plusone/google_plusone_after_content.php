<?php
$data = get_custom_data();
if(!isset($data["disable_google_plusone"]) and is_200()){
    ?>
<span class="plusone">
<g:plusone></g:plusone>
</span>
<?php
    }
