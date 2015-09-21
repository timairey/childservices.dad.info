<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => 's9ghu78m',
	"database" => 'SS_childservices',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');