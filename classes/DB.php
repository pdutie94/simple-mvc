<?php 
class DB {

    public static $host = 'localhost';
    public static $dbName = 'project_excel';
    public static $username = 'root';
    public static $password = '';

    private static function con() {
  
      $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      );
      try {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";", self::$username, self::$password, $options);
        return $pdo;
      } catch ( PDOException $e ) {
        echo $e->getMessage();
      }
    }
    
    public static function query($query, $params = array()) {
      $stmt = self::con()->prepare($query);
      $data = $stmt->execute($params);
      return $data;
    }

    public static function fetch($query, $params = array()) {
      $stmt = self::con()->prepare($query);
      $data = $stmt->execute($params);
      $data = $stmt->fetch();
      return $data;
    }

    public static function fetchAll($query, $params = array()) {
      $stmt = self::con()->prepare($query);
      $data = $stmt->execute($params);
      $data = $stmt->fetchAll();
      return $data;
    }
}