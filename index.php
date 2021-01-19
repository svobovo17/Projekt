<?php
session_start();
$_SESSION["prihlaseni"] = "";
$_SESSION['kod'] = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Appka_prihlaseni</title>
</head>
<body>
	<p>Prihlaseni</p>
	<form action="prihlaseni/prihlaseni.php" method="POST">
		<input type="text" name="uzivatel" placeholder="uzivatelske jmeno"><br>
		<input type="password" name="heslo" placeholder="heslo"><br>
		<input type="password" name="kod" placeholder="unikatni kod"><br><br>
		<input type="submit" name="tlacitko">
	</form>
	<?php
		if (!empty($_SESSION["chyba2"])) {
			echo $_SESSION["chyba2"];
		}
	?>
	<br>
	<a href="registrace/registrace_index.php">Pokud nemas ucet, tady se muzes zaregistrovat</a>
</body>
</html>