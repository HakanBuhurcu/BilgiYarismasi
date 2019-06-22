<?php

header('Content-type: application/json');
require_once __DIR__ . '/baglanti.php';

$puan = 100;//$_POST['puan'];

$db = new DB_CONNECT();
$con = $db->connect();

$sorgu = $con->prepare("SELECT Soru,a,b,c,d,Cvp,Puan FROM sorular WHERE Puan =:puan");
$sorgu->bindParam(":puan",$puan,PDO::PARAM_STR);
$sorgu->execute();

$sorular = array();
if($sorgu){
		
  foreach($sorgu->fetchAll() as $row)
   {
	$yeniSoru = array();
	$yeniSoru["Soru"] = $row["Soru"];
	$yeniSoru["a"] = $row["a"];
	$yeniSoru["b"] = $row["b"];
	$yeniSoru["c"] = $row["c"];
	$yeniSoru["d"] = $row["d"];
	$yeniSoru["Cvp"] = $row["Cvp"];
	
 	array_push($sorular,$yeniSoru);
   }
   
    echo json_encode($sorular,JSON_UNESCAPED_UNICODE);
	return;
	
}
return;


?>