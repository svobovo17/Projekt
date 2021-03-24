<?php
	session_start();
	include "../library_prihlasen.php";
	neprihlasen($_SESSION['prihlaseni']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>desifrace</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="desifrace">
		<p id="desifrace_text">Zde zadej klíč pro dešifrování komunikace</p>
		<form action="text.php" method="POST" id="desifrace_form">
			<input type="hidden" name="uzivatel" value="<?php echo $_POST['uzivatel']?>">
			<input type="text" name="klic">
			<input type="submit" value="Přejít na komunikaci">
		</form>
		<form action="zadost.php" method="POST" id="zadost_form">
			<input type="hidden" name="uzivatel" value="<?php echo $_POST['uzivatel']?>">
			<input type="hidden" name="zadost" value="true">
			<input type="submit" value="Požádat o klíč">
		</form>
	</div>
</body>
</html>