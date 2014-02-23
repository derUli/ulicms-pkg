<?php
define("MODULE_ADMIN_HEADLINE", "Häufige Referrer");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "referrer");

function referrer_admin(){
     $referrer_limit = getconfig("referrer_limit");
    
     if($referrer_limit === false)
         $referrer_limit = 10;
    
     $data = db_query("SELECT * FROM " . tbname("referrer") . " ORDER by `amount` DESC LIMIT $referrer_limit");
    
     if(db_num_rows($data) > 0){
         echo "<table>";
         while($row = db_fetch_object($data)){
             echo "<tr>";
             echo "<td style=\"font-weight:bold; min-width:100px;\">" . htmlspecialchars($row -> url, ENT_QUOTES, "UTF-8") . "</td>";
             echo "<td style=\"text-align:right;min-width:100px;\">" . intval($row -> amount) . "</td>";
             echo "</tr>";
             }
        
         echo "</table>";
        
         }else{
         echo "<p>Bisher noch keine Referrer vorhanden</p>";
         }
    
    
    
    
     }
