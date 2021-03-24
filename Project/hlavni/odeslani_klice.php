<?php
session_start();
include "../library.php";
include "../db.php";
print_r($_POST);
$od_uzivatele = $_POST["od_uzivatele"];
$pro_uzivatele = $_POST["pro_uzivatele"];
$klic = htmlspecialchars(strip_tags($_POST["klic"]));

$sql = "SELECT ass_klic FROM `zadost_o_klic` WHERE od_uzivatele = '$pro_uzivatele' AND pro_uzivatele = '$od_uzivatele'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_all($query);


openssl_public_encrypt($klic, $sifrovany_klic, $row[0][0]);
$pro_uzivatele = $_POST["pro_uzivatele"];

$sql = "INSERT INTO `klic` (`klic`, `pro_uzivatele`, `od_uzivatele`) VALUES ('$sifrovany_klic', '$pro_uzivatele', '$od_uzivatele')";
$query = mysqli_query($con,$sql);
$sql = "DELETE FROM `zadost_o_klic` WHERE ID = $id";
$query = mysqli_query($con,$sql);
header("location: index.php");
?>