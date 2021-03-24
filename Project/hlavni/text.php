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
	<link rel="stylesheet" type="text/css" href="style_text.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		/*setInterval(function(){
			$( "#zpravy" ).load(window.location.href + " #zpravy" );
		}, 2000);
	</script>
</head>
<body>
	<div id="header">
		<a href="index.php">Zpet</a>
	</div>
	<div id="chat">
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
						<input id="zprava" type="text" name="zprava" placeholder="Klikni zde a napis zpravu">
						<input type="submit" name="submit" placeholder="Odeslat">
					</form>
		</div>
	</div>
</body>
</html>