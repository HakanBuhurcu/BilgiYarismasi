<?php

header('Content-type: application/json');
require_once __DIR__ . '/baglanti.php';

$id = $_POST['id'];

$db = new DB_CONNECT();
$con = $db->connect();

$sorgu = $con->prepare("SELECT Kullancad,Puan FROM Uyeler ORDER BY Puan DESC");
$sorgu->execute();



$uyeler = array();
foreach($sorgu->fetchAll() as $row)
{
	$newUye = array();
	$newUye["kullaniciadi"] = $row["Kullancad"];
	$newUye["puani"] = $row["Puan"];
	array_push($uyeler,$newUye);
}

$digerSorgu = $con->prepare("SELECT Kullancad,Puan,Oduldurum,Elli,Ybes,Pas,Cift FROM Uyeler WHERE Id =:UyeID");
$digerSorgu->bindParam(":UyeID",$id,PDO::PARAM_STR);
$digerSorgu->execute();

if($digerSorgu)
{
$gelenDeger = $digerSorgu->fetch();
$sonuc = array();
$sonuc["kullaniciadi"] = $gelenDeger["Kullancad"];
$sonuc["puan"] = $gelenDeger["Puan"];
$sonuc["oduldurum"] = $gelenDeger["Oduldurum"];
$sonuc["elli"] = $gelenDeger["Elli"];
$sonuc["ybes"] = $gelenDeger["Ybes"];
$sonuc["pas"] = $gelenDeger["Pas"];
$sonuc["cift"] = $gelenDeger["Cift"];
array_push($uyeler,$sonuc);
}

$con = null;
$db = null;

if($sorgu)
{
	echo json_encode($uyeler,JSON_UNESCAPED_UNICODE);
	return;
}
return;

?>