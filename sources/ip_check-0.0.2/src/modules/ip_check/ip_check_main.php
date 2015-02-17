<?php
function ip_check_render(){
   return '<a href="https://ip-check.info/?lang=en" title="IP check">
   <img src="https://ip-check.org/ip-check.png?edgewise=true&lang='.htmlspecialchars($_SESSION["language"]).'" alt="IP check" width="150" height="150">
</a>';
}