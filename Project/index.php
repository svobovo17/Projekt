<?php
session_start();
$_SESSION["prihlaseni"] = "";
$_SESSION['kod'] = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Appka_prihlaseni</title>
	<link rel="stylesheet" type="text/css" href="style_prihlaseni.css">
</head>
<body>
	<p>Prihlaseni</p>
	<form action="prihlaseni/prihlaseni.php" method="POST">
		<input type="text" name="uzivatel" placeholder="uživatelské jméno" class="tlacitka_prihlaseni"><br>
		<input type="password" name="heslo" placeholder="heslo" class="tlacitka_prihlaseni"><br>
		<input type="password" name="kod" placeholder="unikátní kód" class="tlacitka_prihlaseni"><br>
		<input type="submit" name="tlacitko" id="submit" value="Přihlásit se"><br><br>
		<a href="registrace/registrace_index.php">Pokud nemáš účet, tady se můžeš zaregistrovat</a>
	</form>
	<?php
		if (!empty($_SESSION["chyba2"])) {
			echo $_SESSION["chyba2"];
		}
	?>
</body>
</html>