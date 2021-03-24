<?php
	session_start();
	if (!empty($_SESSION["chyba"])) {
		echo $_SESSION["chyba"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Appka_registrace</title>
	<link rel="stylesheet" type="text/css" href="style_registrace.css">
</head>
<body>
	<div id="registrace_cele">
		<p id="registrace">Registrace</p>
		<form method="POST" action="registrace_action.php">
			<input type="email" name="email" placeholder="E-mail" id="input_email" class="tlacitka_registrace"><br>
			<input type="text" name="uzivatel" placeholder="uživatelské jméno" id="input_uzivatel" class="tlacitka_registrace"><br>
			<input type="password" name="heslo" placeholder="heslo" id="heslo" class="tlacitka_registrace"><br>
			<input type="password" name="heslo_znovu" placeholder="heslo_znovu" id="heslo_znovu" class="tlacitka_registrace"><br>
			<input type="submit" name="submit" id="submit" value="zaregistrovat se"><br><br>
			<a href="../index.php" id="odkaz">Pokud už účet máš, tady se přihlásíš</a>
		</form>
	</div>
</body>
</html>