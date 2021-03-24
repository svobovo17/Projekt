<?php
	include "../library.php";
	include "../db.php";

	$priv_klic = file_get_contents($_POST['file']);

	$id = $_POST["id"];
	$sql = "SELECT * FROM `klic` WHERE ID = '$id'";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_all($query);
	echo $row[0][1];

	openssl_private_decrypt($row[0][1], $klic, $priv_klic);

?>