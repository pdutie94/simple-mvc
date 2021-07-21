<?php
session_start();
date_default_timezone_set( 'Asia/Ho_Chi_Minh' );

require_once '_Globals.php';
// unset($_COOKIE['user_id']); 
// setcookie('user_id', null, -1, '/');

spl_autoload_register(
	function( $className ) {
        require_once __DIR__ . '/classes/' . $className . '.php';
	}
);

require_once 'Routes.php';

// We create a new instance of the 'App' object and execute the run method.
$app = new App();
$app->run();
