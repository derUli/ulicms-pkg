<?php
function clear_apc_cache_render(){
     if(!function_exists("apc_clear_cache")){
       return "<p style='color:red'>Der APC Cache kann nicht gelernt werden, da APC nicht installiert ist.</p>";
  }
  apc_clear_cache();
  apc_clear_cache('user');
  apc_clear_cache('opcode');
  return "<p style='color:green'>Der APC Cache wurde erfolgreich geleert.</p>";
}
