<?php
$data = get_custom_data();
$language = getCurrentLanguage();
if ($language != "de") {
    $language = "en";
}
if (! isset($data ["disable_socialshare"]) and ! isset($data ["disable_facebook_like"]) and ! isset($data ["disable_google_plusone"]) and is_200()) {
    ?>
<script type="text/javascript"
	src="<?php echo getModulePath("jquery_socialshareprivacy"); ?>jquery.socialshareprivacy.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($){
      if($('.socialshareprivacy').length > 0){
        $('.socialshareprivacy').socialSharePrivacy({'services' : {
    'facebook' : {
      'dummy_img' : '<?php echo getModulePath("jquery_socialshareprivacy"); ?>socialshareprivacy/images/dummy_facebook.png',
      'layout' : 'box_count',
      'perma_option' : 'off'
    },
    'twitter' : {
      'dummy_img' : '<?php echo getModulePath("jquery_socialshareprivacy"); ?>socialshareprivacy/images/dummy_twitter.png',
      'count' : 'vertical',
      'perma_option' : 'off'
    },
    'gplus' : {
      'dummy_img' : '<?php echo getModulePath("jquery_socialshareprivacy"); ?>socialshareprivacy/images/dummy_gplus.png',
      'size' : 'tall',
      'perma_option' : 'off'
    }
  },
          "css_path"  : "<?php echo getModulePath("jquery_socialshareprivacy"); ?>socialshareprivacy/socialshareprivacy.css",
          "lang_path" : "<?php echo getModulePath("jquery_socialshareprivacy"); ?>socialshareprivacy/lang/",
          "language"  : "<?php echo $language; ?>"
        });
      }
    });
  </script>
<?php
}
?>
