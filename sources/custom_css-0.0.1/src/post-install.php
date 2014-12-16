<?php 
if(!getconfig("custom_css")){
   $default = "/* Geben Sie hier Ihren CSS Code ein */
";
   setconfig("custom_css", db_escape($default));


}

?>