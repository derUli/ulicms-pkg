<?php
define("MODULE_ADMIN_HEADLINE", "Besucherstatistiken");
define("MODULE_ADMIN_REQUIRED_PERMISSION", 50);


 include(getModulePath("pchart")."class/pData.class.php"); 
 include(getModulePath("pchart")."class/pDraw.class.php"); 
 include(getModulePath("pchart")."class/pImage.class.php"); 

function istatistics_admin(){
     if(!setlocale(LC_TIME, "de_DE")){
         if(!setlocale(LC_TIME, "de_DE.utf8")){
             setlocale(LC_TIME, "deu");
             }
         }
    
     $data = db_query("SELECT * FROM " . tbname("statistics") . " ORDER by date ASC");
    
     $visitor_total = db_num_rows($data);
    
     $views_total = 0;
    
     $gestern = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
     $heute = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
     $morgen = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
    
     $visitors_today = 0;
     $visitors_yesterday = 0;
     $visitors_month = 0;
    
     $firstYear = false;
     $firstMonth = false;
    
     while($row = db_fetch_object($data)){
         $views_total += $row -> views;
         if(!$firstYear){
             $firstYear = date("Y", $row -> date);
             }
        
         if($row -> date >= $heute and $row -> date < $morgen){
             $visitors_today += 1;
             }
        
         if($row -> date >= $gestern and $row -> date < $heute){
             $visitors_yesterday += 1;
             }
        
         if($row -> date >= monatserster and $row -> date < $monatsletzter){
             $visitors_month += 1;
             }
        
         }
    
    
    
    
     ?>
<table>
<tr>
<td style="width:200px;">
<strong>Besucher gesamt</strong></td>
<td style="text-align:right;"><?php echo intval($visitor_total);
     ?>
</td>
</tr>
<tr>
<td style="width:200px;">
<strong>Besucher heute</strong></td>
<td style="text-align:right;"><?php echo intval($visitors_today);
     ?>
</td>
</tr><tr>
<td style="width:200px;">
<strong>Besucher gestern</strong></td>
<td style="text-align:right;"><?php echo intval($visitors_yesterday);
     ?>
</td>
</tr>
<td style="width:200px;">
<strong>Aufrufe gesamt</strong></td>
<td style="text-align:right;"><?php echo intval($views_total);
     ?>
</td>
</tr>
</table>
<br/>
<hr/>
<?php
$besucherarray = array();
$monatsarray = array();
   $MyData = new pData();   
     if($views_total > 0){
         for($i = date("Y"); $i >= $firstYear ; $i--){
             echo "<h2>" . $i . "</h2>";

             $j = $i;
             for($m = 1; $m <= 12; $m++){
                 $d = date('d');
                 $monatserster = mktime(0, 0, 0, $m, 1, $j);
                 $monatsletzter = mktime(0, 0, 0, $m + 1, 0, $j);
                 $data = db_query("SELECT * FROM " . tbname("statistics") . " WHERE date >= $monatserster
	and date < $monatsletzter ORDER by date ASC");
                 if(db_num_rows($data) > 0){
                     $monatname = strftime("%B", $monatserster);
                     $anzahlbesucher = db_num_rows($data);
                       $besucherarray[] = $anzahlbesucher;
                       $monatsarray[] = $monatname;
                     }
                
                 }
             }
   
   $MyData->addPoints($besucherarray, 
   getconfig("homepage_title"));
   
   $MyData->setAxisName(0,"Besucher");
   $MyData->addPoints($monatsarray, "Monate");
    $MyData->setSerieDescription("Monate","Monat");  
          $MyData->setAbscissa("Monate"); 

         $myPicture = new pImage(700,230, $MyData);          $myPicture->Antialias = true; 
         
 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0)); 
  $myPicture->setFontProperties(array("FontName"=> getModulePath("pchart")."fonts/pf_arma_five.ttf","FontSize"=>6)); 
  
 $myPicture->setGraphArea(60,40,650,200); 
  $myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL)); 
  
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));  $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart(); 

 /* Render the picture (choose the best way) */ 

 $file = "../content/tmp/".md5("stat-chart-".strval($i).strval($m)).".png"; $myPicture->Render($file); 
 echo '<img src="'. $file.'" alt="Besucherstatistiken '.$i.'">';


          
          


         }
     ?>

<?php
    
     }

?>