<?php
$data = get_custom_data();
if(!isset($data["disable_facebook_like"])){
?>
<div class="fb-like" data-href="<?php echo htmlspecialchars(getCurrentURL());?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<?php } ?>
