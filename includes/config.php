<?php

define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_LAYOUT', 'default');

//define('DB_HOST', 'localhost');
//define('DB_USER', 'forum');
//define('DB_PASS', '1234');
//define('DB_NAME', 'forum_system');
//define('DEFAULT_PAGE_SIZE', 4);

//define('DB_HOST', 'mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/');
//define('DB_PORT','OPENSHIFT_MYSQL_DB_PORT');
//define('DB_USER', 'admin6yEQBG4');
//define('DB_PASS', '1Ml26zabclSS');
//define('DB_NAME', 'forum_system');
define('DEFAULT_PAGE_SIZE', 4);


define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT'));
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));