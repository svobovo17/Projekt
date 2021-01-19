<?php
include "../db.php";
include "../library.php";
session_start();
$_SESSION["chyba"] = "";
if (empty($_POST["email"])) {
	$_SESSION["chyba"] .= "zadej email<br>";
}
if (empty($_POST["uzivatel"])) {
	$_SESSION["chyba"] .= "zadej uzivatelske jmeno<br>";
}
if (empty($_POST["heslo"])) {
	$_SESSION["chyba"] .= "zadej heslo<br>";
}
if ($_SESSION["chyba"] == "") {
	$uziv = htmlspecialchars(strip_tags($_POST["uzivatel"]));
	$heslo = htmlspecialchars(strip_tags($_POST["heslo"]));
	$hash = hash("sha512", $heslo);
	$email = htmlspecialchars(strip_tags($_POST["email"]));
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