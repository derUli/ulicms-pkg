<?php
function blog_remove_post($post_id) {
	$acl = new ACL ();
	if ($acl->hasPermission ( "blog" )) {
		db_query ( "DELETE FROM `" . tbname ( "blog" ) . "` WHERE id = $post_id" );
		
		Cache::clear ();
		return "<p>Der Blogpost wurde erfolgreich gelöscht!</p>";
	} else {
		return "<p>Zugriff verweigert!</p>";
	}
}
function blog_remove_comment($post_id) {
	$acl = new ACL ();
	if ($acl->hasPermission ( "blog" )) {
		db_query ( "DELETE FROM `" . tbname ( "blog_comments" ) . "` WHERE id = $post_id" );
		
		Cache::clear ();
		return "<script type='text/javascript'>
	   history.back();
	   </script>";
	} else {
		return "<p>Zugriff verweigert</p>";
	}
}
?>