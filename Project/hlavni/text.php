<?php
	session_start();
	include "../library.php";
	include "../db.php";
	include "../library_prihlasen.php";
		neprihlasen($_SESSION['prihlaseni']);
	$_SESSION["vybrany_uzivatel"] = "";
	if (!empty($_POST)) {
		$_SESSION["post"] = $_POST;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
</head>
<body>
	<div id="header">
		<a href="index.php">Zpet</a>
	</div>
	<div id="zpravy">
		<?php
			$me = select_uzivatel_id($_SESSION["uzivatel"]);
			$the_other = select_uzivatel_id($_SESSION['post']['uzivatel']);
			echo chat_zpravy($me, $the_other);
		?>
	</div>
	<div id="pole_pro_psani">
				<form method="post" action="zapis.php">
					<input type="hidden" name="uzivatel" value="<?php echo $_SESSION['post']['uzivatel']?>">
					<input type="hidden" name="klic" value="<?php echo $_SESSION['post']['klic']?>">
					<input type="text" name="zprava" placeholder="Klikni zde a napis zpravu">
					<input type="submit" placeholder="Odeslat">
				</form>
	</div>
</body>
</html>