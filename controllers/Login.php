<?php
class LoginController {
	public static function getUser( $username ) {
		$sql  = 'SELECT * FROM users WHERE username=:username OR email=:username';
		$user = DB::fetch( $sql, array( ':username' => $username ) );

		return $user;
	}
}
