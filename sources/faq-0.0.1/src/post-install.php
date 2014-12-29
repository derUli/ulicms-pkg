<?php
db_query("Create table ".tbname("faq")."
(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
question VARCHAR(255) NULL,
answer text NULL
)");

$q = query("select id from ".tbname("faq"). " LIMIT 1");
if(db_num_rows($q) == 0){
  $question = db_escape("Was ist UliCMS?");
  $answer = db_escape("UliCMS ist ein professionelles Web Content Management-System welches von Ulrich Schmidt seit dem Jahr 2011 entwickelt wird.");
  db_query("INSERT INTO ".tbname("faq"). " (question, answer) VALUES ('$question', '$answer')");

}