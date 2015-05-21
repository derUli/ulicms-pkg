<?php 
$data = get_custom_data();
if(!isset($data["disable_socialshare"]) and is_200()){
?>

  <div class="socialshareprivacy"></div>
<?php 
}
?>