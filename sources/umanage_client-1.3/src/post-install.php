<?php

Database::query("CREATE TABLE `" . tbname("umanage_sites") . "` ( `id` INT NOT NULL AUTO_INCREMENT ,
		`protocol` VARCHAR(10) NOT NULL DEFAULT 'http://' , `domain` VARCHAR(255) NOT NULL ,
		`path` VARCHAR(255) NOT NULL DEFAULT '/' , `api_key` VARCHAR(180) NOT NULL,
		`enabled` TINYINT(1) NOT NULL DEFAULT 1 , PRIMARY KEY (`id`) );");
