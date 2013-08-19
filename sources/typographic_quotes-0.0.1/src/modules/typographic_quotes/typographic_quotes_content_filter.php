<?php 
// Ersetze doppelte Anführungszeichen durch Typographische
function typographic_quotes_content_filter($input){
   $returnval = "";
   $input = str_replace("&quot;", "\"", $input);
   $quote = false;
   $tag_open = false;
   $code_or_pre = false;
   for($i=0; $i<strlen($input); $i++){
   
      switch($input[$i]){
         case "\"":
         if($quote and !$tag_open and !$code_or_pre){
            $returnval .= "“";
            $quote = false;
         } else if(!$quote and !$tag_open and !$code_or_pre){
           $quote = true;
           $returnval .= "„";
         } else{
           $returnval .= $input[$i];
         }
         break;
         case "<":
         $tag_open = true;
         $returnval .= $input[$i];
         break;
         case ">":
         $tag_open = false;
         $returnval .= $input[$i];
         break;
         default:
         $returnval .= $input[$i];
         break;
      }
      
      if(endsWith(strtolower($returnval), "<code>") or 
         endsWith(strtolower($returnval), "<pre>"))
         $code_or_pre = true;
         
     if(endsWith(strtolower($returnval), "</code>") or 
        endsWith(strtolower($returnval), "</pre>"))
         $code_or_pre = false;
      
   }
   return $returnval;
}
?>