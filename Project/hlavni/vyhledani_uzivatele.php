<?php
	session_start();
	include "../library.php";
	include "../db.php";
	if ($_POST != "") {
		$_SESSION['vybrany_uzivatel'] = vyber_uzivatelu($_SESSION['uzivatel'], $_POST["search"]);
	}
	header('location:index.php');
?>