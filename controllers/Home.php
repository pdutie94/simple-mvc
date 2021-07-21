<?php
class HomeController {
	public static function getTable() {
		$sql   = 'SELECT * FROM table_data';
		$table = DB::fetch( $sql );

		return $table;
	}

	public static function addData( $fullName, $content ) {
		$sql  = 'INSERT INTO report ( fullname, content ) VALUES ( :fullname, :content )';
		$data = DB::query(
			$sql,
			array(
				':fullname' => $fullName,
				':content'  => $content,
			)
		);

		return $data;
	}
}
