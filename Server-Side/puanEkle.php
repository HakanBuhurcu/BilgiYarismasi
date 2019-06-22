<?php

header('Content-type: application/json');
require_once __DIR__ . '/baglanti.php';

$puan= $_POST['puan'];
$id= $_POST['id'];

$db = new DB_CONNECT();
$con = $db->connect();

$sorgu = $con->prepare("UPDATE uyeler SET Puan = Puan + :puan WHERE Id = :Id");
$sorgu->bindParam(":puan",$puan,PDO::PARAM_STR);
$sorgu->bindParam(":Id",$puan,PDO::PARAM_STR);
$sorgu->execute();

if($sorgu){
	echo "done";
}


?>