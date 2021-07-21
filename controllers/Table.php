<?php 
class TableController {
    public static function getTable() {
        $sql = "SELECT * FROM table_data";
        $table = DB::fetch($sql);

        return $table;
    }

    public static function updateTable($id, $content) {
        $sql = "UPDATE table_data SET content=:content WHERE id=:id";
        $table = DB::query($sql, [':content' => $content, ':id' => $id]);

        return $table;
    }

    public static function addTable($content) {
        $sql = "INSERT INTO table_data ( content ) VALUES ( :content )";
        $table = DB::query($sql, [':content' => $content]);

        return $table;
    }
}