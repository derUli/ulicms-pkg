<?php
$acl = new ACL();
if (in_array("blog", getAllModules()) and $acl->hasPermission("blog_comments_dashboard")) {
    ?>

<h2 class="accordion-header"><?php translate("new_comments"); ?></h2>
<div class="accordion-content">
<?php
    if (isset($_GET ["delete_comment"])) {
        db_query("DELETE FROM " . tbname("blog_comments") . " WHERE id=" . intval($_GET ["delete_comment"]));
    }
    
    $query = db_query("SELECT * FROM " . tbname("blog_comments") . " ORDER by `date` DESC LIMIT 5");
    
    if (db_num_rows($query) === 0) {
        echo "<p>" . get_translation("no_comments") . "</p>";
    } else {
        $html = "";
        
        while ($comment = db_fetch_object($query)) {
            $count ++;
            
            $html .= "<div class='a_comment'>
	   <a href='#comment" . $comment->id . "' name='comment" . $comment->id . "'>";
            $html .= "#" . $count;
            
            $html .= "</a>";
            
            if ($acl->hasPermission("blog")) {
                $html .= " <a href='index.php?delete_comment=" . $comment->id . "' onclick='return confirm(\"" . get_translation("really_delete_comment") . "\")'>[" . get_translation("delete") . "]</a>";
            }
            
            $html .= "<br/>";
            $html .= "<br/>";
            $html .= "<strong>Name: </strong>";
            $html .= $comment->name;
            $html .= "<br/>";
            
            if ($acl->hasPermission("blog")) {
                $html .= "<strong>" . get_translation("email") . ": </strong>" . $comment->email . "<br/>";
            }
            $html .= "<strong>";
            $html .= get_translation("date");
            $html .= ":</strong>";
            
            $html .= " ";
            $html .= date(getconfig("date_format"), $comment->date);
            if ($comment->url != "http://" and $comment->url != "") {
                $html .= "<br/>";
                $html .= "<strong>Homepage:</strong> " . "<a href='" . $comment->url . "' target='_blank' rel='nofollow'>" . $comment->url . "</a>";
            }
            $html .= "<br/><br/>";
            $html .= make_links_clickable(nl2br(htmlspecialchars($comment->comment)));
            
            $html .= "<br/><br/>";
            
            if ($count != db_num_rows($query)) {
                $html .= "<hr/>";
            }
            
            $html .= "</div>";
        }
        
        echo $html;
    } ?>
</div>
<?php
}

?>
