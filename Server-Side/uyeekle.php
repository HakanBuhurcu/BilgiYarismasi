<?php

header('Content-type: application/json');
require_once __DIR__ . '/baglanti.php';

$kullaniciadi = $_POST['kullaniciadi'];
$mail = $_POST['mail'];
$sifre = $_POST['sifre'];


if($kullaniciadi!= "" && $mail != "" && $sifre!= "")
{
	$db = new DB_CONNECT();
	$con = $db->connect();
	
	
	$sorgu = $con->prepare("INSERT into Uyeler SET
	Kullancad = ?,
	Mail = ?,
	Sifre = ?
	");
	$insert = $sorgu->execute(array($kullaniciadi,$mail,md5($sifre)));
	
	$idsorgulama = $con->prepare("SELECT Id FROM Uyeler WHERE Kullancad = ? and Sifre = ?");
	$idsorgulama->execute(array($kullaniciadi,md5($sifre)));
	$con = null;
	$db = null;
	
	if($insert && $idsorgulama)
	{    
        $kayitID = $idsorgulama->fetch();
		/*$sonuc = array();
		$sonuc["id"] = $kayitID[id];*/
		echo json_encode($kayitID["Id"],JSON_UNESCAPED_UNICODE);
		return;
	}
	return;
}






?>