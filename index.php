<?php

spl_autoload_register(function($className) {
    if( file_exists(__DIR__ . '/classes/'.$className.'.php') ) {
        require_once __DIR__ . '/classes/'.$className.'.php';
    } else if (file_exists(__DIR__ . '/controllers/'.$className.'.php')) {
        require_once __DIR__ . '/controllers/'.$className.'.php';
    }
});


require_once 'Routes.php';