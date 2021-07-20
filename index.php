<?php
session_start();
// unset($_SESSION['user_id']);
// unset($_SESSION['last_login_timestamp']);
require_once '_Globals.php';

spl_autoload_register(
	function( $className ) {
        require_once __DIR__ . '/classes/' . $className . '.php';
	}
);


require_once 'Routes.php';

// We create a new instance of the 'App' object and execute the run method.
$app = new App();
$app->run();
