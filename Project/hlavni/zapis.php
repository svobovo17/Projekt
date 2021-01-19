<?php
session_start();
include "../library.php";
include "../db.php";

/*úprava dat před SQL injection útokem*/
$zprava_osetrena = htmlspecialchars(strip_tags($_POST['zprava']));
/*Zjištění ID uživatelů pomocí jejich uživatelských jmen*/
$odesilatel_id = select_uzivatel_id($_SESSION['uzivatel']);
$prijemce_id = select_uzivatel_id($_POST['uzivatel']);

/*Proces šifrování zpráv*/
/*Text který chceme zašifrovat, klíč kterým to budeme šifrovat a dešifrovat a šifra, kterou použijeme*/
$plaintext = $_POST['zprava'];
$key = $_POST['klic'];
$cipher = "aes-256-cbc";
		/*proces šifrování*/
		/*délka šifry*/
	    $ivlen = openssl_cipher_iv_length($cipher);
	    $iv =  openssl_random_pseudo_bytes($ivlen);
	   	$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		/*zakóduje zašifrovaný text pomocí base64*/
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
/*Vložení zašifrované zprávy společně s ID odesílatele a příjemce*/
$sql = "INSERT INTO `chat` (`zprava`, `odesilatel_id`, `prijemce_id`) VALUES ('$ciphertext', '$odesilatel_id', '$prijemce_id')";
$query = mysqli_query($con, $sql);
header("location: text.php");
?>