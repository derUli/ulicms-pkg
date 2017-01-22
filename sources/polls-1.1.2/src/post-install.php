<?php
// Questions Tabelle anlegen
Database::query ( "CREATE TABLE IF NOT EXISTS `" . tbname ( "poll_questions" ) . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;" );

// Answers Tabelle anlegen
Database::query ( "CREATE TABLE IF NOT EXISTS `" . tbname ( "poll_answers" ) . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `amount` int default 0,
  `question_id` int not null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;" );

// Fremdschlüssel hinzufügen
// Beim Löschen einer Frage werden alle dazugehörigen Antworten gelöscht
Database::query ( "ALTER TABLE `" . tbname ( "poll_answers" ) . "` ADD
    CONSTRAINT `Constr_question_answers_fk`
    FOREIGN KEY `questions_fk` (`question_id`) REFERENCES `" . tbname ( "poll_questions" ) . "` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE" );

Settings::register ( "poll_max_items", 10 );