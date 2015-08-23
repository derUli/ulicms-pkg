<?php
$facebook_like_button_layout = getconfig("facebook_like_button_layout");
$facebook_like_button_data_colorscheme = getconfig("facebook_like_button_data_colorscheme");
$facebook_like_button_action = getconfig("facebook_like_button_action");
$facebook_like_button_show_faces = getconfig("facebook_like_button_show_faces");
$facebook_like_button_share = getconfig("facebook_like_button_share");
$data = get_custom_data();
if(!isset($data["disable_facebook_like"]) and is_200()){
     ?>
<div class="fb-like" data-href="<?php echo htmlspecialchars(getCurrentURL());
     ?>" data-layout="<?php echo $facebook_like_button_layout;
     ?>" data-colorscheme="<?php echo $facebook_like_button_data_colorscheme;
     ?>" data-action="<?php echo $facebook_like_button_action;
     ?>" data-show-faces="<?php echo $facebook_like_button_show_faces;
     ?>" data-share="<?php echo $facebook_like_button_share;
     ?>"></div>
<?php }
?>
