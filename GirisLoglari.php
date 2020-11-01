<?php

session_start();
date_default_timezone_set("Europe/Istanbul");

require_once('baglanti.php');
$mysqli = BaglantiAc();


//IP
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
//IP
//Giris_Loglari
$TempKullaniciID = $_SESSION['KullaniciID'];
$TempGirisTarihi = date("d-m-Y  h:i ");
$TempIPAdresi = $ip;

$sorgu="INSERT INTO Giris_Loglari (id,KisiID, IPAdresi, Tarih) VALUES (NULL, $TempKullaniciID,'$TempIPAdresi','$TempGirisTarihi')";
$ekle=$mysqli->prepare($sorgu);
$ekle->execute();

$mysqli->close();
$ekle->close();


?>