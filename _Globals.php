<?php 
$Routes = array();

/**
 * We define the BASEDIR. This is the directory that How is stored in. This constant
 * will eventually be set by the installer when it is created.
*/
define( 'BASEDIR', '/simple-mvc/' );

if ( isset( $_SERVER['HTTPS'] ) ) {
	$protocol = ( $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off' ) ? 'https' : 'http';
} else {
	$protocol = 'http';
}
$base_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . dirname( $_SERVER['REQUEST_URI'] . '?' ) . '/';
define( 'BASEURL', $base_url );