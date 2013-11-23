<?php 
function countdown_render(){
   $end_date = getconfig("countdown_to_date");
   if($end_date === false)
      return "";
	  
	$end_date = intval($end_date);
   $time_difference = $end_date - time();
    
   if($time_difference < 0)
       $time_difference = 0;
   
   return '<script>
   new Countdown({time:'.$time_difference.'});
</script>';

}
?>