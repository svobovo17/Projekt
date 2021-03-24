<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="desifrovani_klice_action.php" method="POST">
		<input type="file" name="file">
		<input type="hidden" name="id" value="<?php echo $_POST['id']?>">
		<input type="submit">
	</form>
</body>
</html>