<?php
	function neprihlasen($prihlasen){
		if (empty($prihlasen)) {
			header("location: ../index.php");
		}
	}
?>