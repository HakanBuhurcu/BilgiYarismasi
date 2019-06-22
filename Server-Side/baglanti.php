<?php
class DB_CONNECT {
    function __construct() {  }
    function __destruct() { $this->close();  }
    function connect() {
        require_once __DIR__ . '/config.php';
		try {
			 $con = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE.";charset=utf8", DB_USER, DB_PASSWORD);
			 
		} catch ( PDOException $e ){
			 print $e->getMessage();
		}
        return $con;
    }
    function close() {  $con = null; }
}
?>