<?php
	session_start();
	include "../library_prihlasen.php";
	neprihlasen($_SESSION['prihlaseni']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>desifrace</title>
</head>
<body>
	<form action="text.php" method="POST">
		<input type="hidden" name="uzivatel" value="<?php echo $_POST['uzivatel']?>">
		<input type="text" name="klic">
		<input type="submit">
	</form>
</body>
</html>