<?php
db_query ( "Create table " . tbname ( "faq" ) . "
(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
question VARCHAR(255) NULL,
answer text NULL
)" );

$q = db_query ( "select id from " . tbname ( "faq" ) . " LIMIT 1" );
if (db_num_rows ( $q ) == 0) {
	$question = db_escape ( "Was ist UliCMS?" );
	$answer = db_escape ( "UliCMS ist ein professionelles Web Content Management-System welches von Ulrich Schmidt seit dem Jahr 2011 entwickelt wird." );
	db_query ( "INSERT INTO " . tbname ( "faq" ) . " (question, answer) VALUES ('$question', '$answer')" );
}

?>
<p>
	Bitte beachten Sie, dass Sie noch Ihr Stylesheet für die FAQ-Seite
	anpassen müssen.<br /> <br /> Sie können die Datei <a
		href="scripts/vallenato/vallenato.css" target="_blank">scripts/vallenato/vallenato.css</a>
	als Vorlage nehmen
</p>
</p>