<?php
include "../db.php";
include "../library.php";
session_start();
$uziv = htmlspecialchars(strip_tags($_POST["uzivatel"]));
$heslo = htmlspecialchars(strip_tags($_POST["heslo"]));
$email = htmlspecialchars(strip_tags($_POST["email"]));
$_SESSION["chyba"] = "";

if (empty($email)) {
	$_SESSION["chyba"] .= "zadej email<br>";
}
if (empty($uziv)) {
	$_SESSION["chyba"] .= "zadej uzivatelske jmeno<br>";
}
if (empty($heslo)) {
	$_SESSION["chyba"] .= "zadej heslo<br>";
}
if ($heslo != $_POST["heslo_znovu"]) {
	$_SESSION["chyba"] .= "hesla nejsou stejna<br>";
}
if (strlen($heslo) < 8) {
	$_SESSION["chyba"] .= "heslo musi byt delsi nez 8 znaku<br>";
}
if ((preg_match("/[A-Z]/", $heslo) == 0 or (preg_match("/[0-9]/", $heslo)) == 0)) {
	$_SESSION["chyba"] .= "heslo musi obsahovat velke pismeno a cislici<br>";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$_SESSION["chyba"] .= "spatny format emailu<br>";
}
if ($_SESSION["chyba"] == "") {
	$hash = hash("sha512", $heslo);
	$sql = "INSERT INTO uzivatele (`uzivatelske_jmeno`, `email`, `heslo`) VALUES ('$uziv', '$email', '$hash')";
	$query = mysqli_query($con,$sql);
	$id_uziv = select_uzivatel_id($uziv);
	$abeceda = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$kod = substr(str_shuffle($abeceda), 0, 10);
	$hash_kod = hash("sha512", $kod);
	$sql = "INSERT INTO kod (`kod`, `uzivatel_id`) VALUES ('$hash_kod', '$id_uziv')";
	$query = mysqli_query($con, $sql);
	$_SESSION['kod'] = $kod;
	header("location: kod.php");
}else{
	header("location: registrace_index.php");
}
?>