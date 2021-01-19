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
</head>
<body>
	<p>Registrace</p>
	<form method="POST" action="registrace_action.php">
		<input type="email" name="email" placeholder="E-mail"><br>
		<input type="text" name="uzivatel" placeholder="Uzivatelske jmeno"><br>
		<input type="password" name="heslo" placeholder="heslo"><br>
		<input type="submit" name="submit"><br><br>
		<a href="../index.php">Pokud uz ucet mas, tady se prihlasis</a>
	</form>
</body>
</html>