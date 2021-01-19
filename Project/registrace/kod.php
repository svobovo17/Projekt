<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>kod</title>
</head>
<body>
	<p>Toto je tvůj unikátní kód, který musíte zadat při přihlášení : <?php echo $_SESSION['kod']?></p>
	<p>Tento kód nikomu neukazujte</p>
	<a href="../index.php">Zpet na prihlaseni</a>
</body>
</html>