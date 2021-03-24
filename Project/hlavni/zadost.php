<?php
	session_start();
	include "../library.php";
	include "../db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Žádost o klíč</title>
</head>
<body>
<?php
	if ($_POST["zadost"] == "true") {
		insert_zadost($_SESSION["uzivatel"], $_POST["uzivatel"]);
		echo "<a href='sifra.txt'>Stahnout klic</a><br>";
		echo "<a href='index.php'>Zpet na hlavni stranu</a>";
	}else {
?>
	<form action="odeslani_klice.php" method="POST">
		<input type="text" name="klic" placeholder="Klíč"><br>
		<input type="hidden" name="pro_uzivatele" value="<?php echo $_POST['pro_uzivatele']?>">
		<input type="hidden" name="uzivatel" value="<?php echo $_POST['uzivatel'] ?>">
		<input type="hidden" name="od_uzivatele" value="<?php echo $_POST['od_uzivatele']?>">
		<input type="submit" value="Odeslat klíč">
	</form>
	<?php
		}
	?>
</body>
</html>