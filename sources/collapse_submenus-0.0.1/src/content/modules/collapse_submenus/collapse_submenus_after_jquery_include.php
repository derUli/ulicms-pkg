
<script type="text/javascript">
$(document).ready(function(){
  $("ul.menu_left li:has(ul) li").hide(); 
  $("ul.menu_right li:has(ul) li").hide(); 
  $("a.menu_active_link").parents().show();
  $("a.menu_active_link").parents("ul:first").children("li").show();
});
</script>

