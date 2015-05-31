<?php
if(!function_exists("is_night")){
// Check if it is night (current hour between 0 and 4 o'Clock AM)
function is_night(){
   $hour = date("G", time());
   return  $hour >= 0 and $hour <= 4;
}

}


if(!is_night()){
   exit();
}