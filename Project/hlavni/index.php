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
	<title>Hlavni strana</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<div id="header">
		<a href="../odhlaseni.php">Odhlasit se</a>
		<p>Přihlášený uživatel <?php echo $_SESSION['uzivatel']?></p>
	</div>
	<div id="chat">
		<div id="uzivatele">
			<form action="vyhledani_uzivatele.php" method="POST">
				<input type="text" name="search">
				<input type="submit">
			</form>
			<?php
				if (!empty($_SESSION["vybrany_uzivatel"])) {
					echo vypis_uzivatele($_SESSION['vybrany_uzivatel']);
				}
			?>
		</div>
		<!--rozpracováno
		<div id="historie">
			<?php
				//echo chat_historie($_SESSION['uzivatel']);
			?>
		</div>
		-->
	</div>
</body>
</html>