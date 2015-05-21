<?php 
$data = get_custom_data();
$language = getCurrentLanguage();
if($language != "de")
   $language = "en";
if(!isset($data["disable_socialshare"]) and is_200()){
?>
  <script type="text/javascript" src="<?php echo getModulePath("jquery_socialshareprivacy");?>jquery.socialshareprivacy.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      if($('.socialshareprivacy').length > 0){
        $('.socialshareprivacy').socialSharePrivacy({
          "css_path"  : "<?php echo  getModulePath("jquery_socialshareprivacy");?>js/plugins/socialshareprivacy/socialshareprivacy.css",
          "lang_path" : "<?php echo  getModulePath("jquery_socialshareprivacy");?>js/plugins/socialshareprivacy/lang/",
          "language"  : "<?php echo $language;?>"
        });
      }
    });
  </script>
 <?php
}
?>