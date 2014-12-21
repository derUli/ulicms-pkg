<?php
$acl = new ACL();
if(in_array("blog", getAllModules()) and $acl -> hasPermission("blog")){
     ?>

<?php
     $query = db_query("SELECT count(*) AS anzahl FROM " . tbname("blog"));
     $result = db_fetch_assoc($query);
     $blog_post_count = $result["anzahl"];
    
     $query = db_query("SELECT count(*) AS anzahl FROM " . tbname("blog_comments"));
     $result = db_fetch_assoc($query);
     $comment_count = $result["anzahl"];
    
    
     $query = db_query("SELECT title, `views` FROM " . tbname("blog") . " ORDER by `views` DESC LIMIT 5");
    
    
     ?>

<h2 class="accordion-header">Blog Statistiken</h2>
<div class="accordion-content">
<table style="400px;">
<tr>
<td style="width:200px;"><strong>Anzahl der Blogposts:</td>
<td style="text-align:right;"><?php echo intval($blog_post_count);
     ?>
</tr>
<tr>
<td><strong>Anzahl der Kommentare:</td>
<td style="text-align:right;"><?php echo intval($comment_count);
     ?></td>
</tr>
</table>
</div>
<h2 class="accordion-header">Beliebteste Blogartikel</h2>
<div class="accordion-content">
<?php if($blog_post_count === 0){
         echo "<p>Es sind noch keine Blogartikel vorhanden.</p>";
         }else ?>
<table>
<tr>
<td><strong>Titel</strong></td>
<td><strong>Views</strong></td>
</tr>
<?php
         while($row = db_fetch_object($query)){
         ?>
<tr>
<td style="padding-right:50px;"><?php echo htmlspecialchars($row -> title, ENT_QUOTES, "UTF-8");
         ?></td>
<td style="text-align:right;"><?php echo $row -> views;
         ?></td>
</tr>
<?php
         }
     ?>

</table>

</div>


<?php
     }
?>
