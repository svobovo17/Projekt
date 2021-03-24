<?php
session_start();
include "../db.php";
include "../library.php";
include "../library_prihlasen.php";
	neprihlasen($_SESSION['prihlaseni']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hlavní strana</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<div id="header">
		<span id="uzivatel_prihlasen">Přihlášený uživatel: <?php echo $_SESSION['uzivatel']?></span>
		<a href="../odhlaseni.php" id="odhlaseni">Odhlásit se</a>
	</div>
	<div id="chat">
		<form action="vyhledani_uzivatele.php" method="POST">
			<input type="text" name="search">
			<input type="submit" value="vyhledat">
		</form>
		<?php
			if (!empty($_SESSION["vybrany_uzivatel"])) {
				echo vypis_uzivatele($_SESSION['vybrany_uzivatel']);
			}else {
				echo seznam($_SESSION['uzivatel']);
			}
		?>
	</div>
</body>
</html>