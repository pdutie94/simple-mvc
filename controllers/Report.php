<?php
class ReportController {
	public static function getTable() {
		$sql  = 'SELECT * FROM table_data';
		$data = DB::fetch( $sql );

		return $data;
	}

	public static function getAllReport() {
		$sql  = 'SELECT * FROM report';
		$data = DB::fetchAll( $sql );

		return $data;
	}
}
