<?php
	include "../db.php";
	session_start();
	$_SESSION["prihlaseni"] = "B";
	if (empty($_POST["heslo"]) or empty($_POST["uzivatel"]) or empty($_POST['kod'])){
		$_SESSION["chyba2"] = "zadej prihlasovaci udaje";
		header("Location:../index.php");
	}else {
		$jmeno = htmlspecialchars(strip_tags($_POST["uzivatel"]));
		$heslo = htmlspecialchars(strip_tags($_POST["heslo"]));
		$password = hash('sha512', $heslo);
		$kod_hash = hash('sha512', $_POST['kod']);
		$sql = "SELECT * FROM uzivatele WHERE `uzivatelske_jmeno` = '$jmeno' AND `heslo` = '$password'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		if (!empty($row)) {
			$id = $row['0']['0'];
			$sql = "SELECT kod FROM kod WHERE `uzivatel_id` = '$id'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_all($query);
			if ($row['0']['0'] == $kod_hash) {
				$_SESSION["prihlaseni"] = "prihlasen";
				$_SESSION["uzivatel"] = $jmeno;
				header("location:../hlavni");
			}else{
				header("location: ../index.php");
			}
		}else {
			$_SESSION["chyba2"] = "spatne prihlasovaci udaje";
			header("location:../index.php");
		}
	}
?>