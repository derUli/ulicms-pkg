<?php
$acl = new ACL ();
if (in_array ( "blog", getAllModules () ) and $acl->hasPermission ( "blog" )) {
	?>

<?php
	$query = db_query ( "SELECT count(id) as amount FROM " . tbname ( "blog" ) );
	$result = Database::fetchObject ( $query );
	$blog_post_count = $result->amount;
	
	$query = db_query ( "SELECT count(id) as amount FROM " . tbname ( "blog_comments" ) );
	$result = Database::fetchObject ( $query );
	$comment_count = $result->amount;
	
	$query = db_query ( "SELECT title, `views` FROM " . tbname ( "blog" ) . " ORDER by `views` DESC LIMIT 5" );
	
	?>

<h2 class="accordion-header"><?php translate("BLOG_STATISTICS");?></h2>
<div class="accordion-content">
	<table style="">
		<tr>
			<td style="width: 200px;"><strong><?php translate("AMOUNT_OF_BLOG_POSTS");?></td>
			<td style="text-align: right;"><?php
	
	echo intval ( $blog_post_count );
	?>

		
		
		
		</tr>
		<tr>
			<td><strong><?php translate("AMOUNT_OF_BLOG_COMMENTS");?></td>
			<td style="text-align: right;"><?php
	
	echo intval ( $comment_count );
	?></td>
		</tr>
	</table>
</div>
<h2 class="accordion-header"><?php translate("MOST_POPULAR_BLOG_POSTS")?></h2>
<div class="accordion-content">
<?php
	
	if ($blog_post_count === 0) {
		echo "<p>" . get_translation ( "no_blog_posts_there_yet" ) . "</p>";
	} else
		?>
<table>
		<tr>
			<td><strong>Titel</strong></td>
			<td><strong>Views</strong></td>
		</tr>
<?php
	while ( $row = db_fetch_object ( $query ) ) {
		?>
<tr>
			<td style="padding-right: 50px;"><?php
		
		echo htmlspecialchars ( $row->title, ENT_QUOTES, "UTF-8" );
		?></td>
			<td style="text-align: right;"><?php
		
		echo $row->views;
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
