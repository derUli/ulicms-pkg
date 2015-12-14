<?php
function countdown_render() {
	$end_date = getconfig ( "countdown_to_date" );
	$retval = "";
	if ($end_date === false)
		return $retval;
	
	$end_date = intval ( $end_date );
	$time_difference = $end_date - time ();
	
	if ($time_difference < 0)
		$time_difference = 0;
	
	$countdown_range_hi = "year";
	
	$year = 60 * 60 * 24 * 365;
	$month = 60 * 60 * 24 * 31;
	$day = 60 * 60 * 24;
	$hour = 60 * 60;
	$minute = 60;
	
	if ($time_difference >= $year)
		$countdown_range_hi = "year";
	else if ($time_difference >= $month)
		$countdown_range_hi = "month";
	else if ($time_difference >= $day)
		$countdown_range_hi = "day";
	else if ($time_difference >= $hour)
		$countdown_range_hi = "hour";
	else if ($time_difference >= $minute)
		$countdown_range_hi = "minute";
	else
		$countdown_range_hi = "second";
	
	$countdown_width = getconfig ( "countdown_width" );
	$countdown_height = getconfig ( "countdown_height" );
	$countdown_style = getconfig ( "countdown_style" );
	$countdown_target = getconfig ( "countdown_target" );
	$countdown_oncomplete = getconfig ( "countdown_oncomplete" );
	
	$retval = '<script type="text/javascript">
   new Countdown({
   time: ' . $time_difference . ',
   width: ' . $countdown_width . ',
   height: ' . $countdown_height . ',
   rangeHi: "' . $countdown_range_hi . '"';
	
	if (! empty ( $countdown_target ) and $countdown_target != false) {
		$retval .= ",
target : \"" . $countdown_target . "\"";
	}
	
	if (! empty ( $countdown_oncomplete ) and $countdown_oncomplete != false) {
		$retval .= ",
onComplete : " . $countdown_oncomplete;
	}
	
	$retval .= ',
   style : "' . $countdown_style . '"
});
</script>';
	return $retval;
}
?>