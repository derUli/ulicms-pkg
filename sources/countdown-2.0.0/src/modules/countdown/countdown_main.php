<?php 
function countdown_render(){
   $end_date = getconfig("countdown_to_date");
   $retval = "";
   if($end_date === false)
      return $retval;
	  
	$end_date = intval($end_date);
   $time_difference = $end_date - time();
    
   if($time_difference < 0)
       $time_difference = 0;
	   
	$countdown_width = getconfig("countdown_width");
	$countdown_height = getconfig("countdown_height");
	$countdown_style = getconfig("countdown_style");
   
   $retval = '<script>
   new Countdown({
   time:'.$time_difference.',
   width: '.$countdown_width.',
   height: '.$countdown_height.',
   countdown_style : "'.$countdown_style.'"});
</script>';
   return $retval;
}
?>