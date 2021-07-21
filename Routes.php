<?php

Route::set(
	'',
	function() {
		View::make( 'Home' );
	}
);

Route::set(
	'login',
	function() {
		View::make( 'Login' );
	}
);

Route::set(
	'edit-table',
	function() {
		View::make( 'Table' );
	}
);

Route::set(
	'report',
	function() {
		View::make( 'Report' );
	}
);
