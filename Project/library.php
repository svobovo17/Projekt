<?php
	/*funkce pro vybrání uživatelů*/
	function vyber_uzivatelu($uzivatel, $hledany){
		global $con;
		$sql = "SELECT uzivatelske_jmeno FROM uzivatele WHERE uzivatelske_jmeno != '$uzivatel' AND uzivatelske_jmeno = '$hledany'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			$row = mysqli_fetch_all($query);
		}return $row['0']['0'];
	}
	/*funkce pro vypisování vyhledávaných uživatelů*/
	function vypis_uzivatele($row){
		if ($row != "") {
			/*vypsání vyhledaných uživatelů*/
			$vysledek = "<div class='jednotlivy_uzivatele'><span class='jmena_seznam'>".$row."</span><form action='desifrovani.php' method='POST'><input type='submit' name='uzivatel' value='přejít na chat'></form></div>";
		}else{
			/*pokud žádný uživatel není nalezen, zobrazí se toto*/
			$vysledek = "<div class='jednotlivy_uzivatele'><span>Nikdo tu neni, zkus nekoho vyhledat</span></div>";
		}
			return $vysledek;
	}
	/*funkce pro zjištění ID uživatele pomocí uživatelských jmen*/
	function select_uzivatel_id($uzivatel){
		global $con;
		$sql = "SELECT id FROM `uzivatele` WHERE uzivatelske_jmeno = '$uzivatel'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		return $row['0']['0'];
	}
	function select_uzivatel_jmeno($uzivatel){
		global $con;
		$sql = "SELECT uzivatelske_jmeno FROM `uzivatele` WHERE id = '$uzivatel'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		return $row['0']['0'];
	} 
	/*funkce pro dešifrování a vypsání zpráv*/
	function chat_zpravy($odesilatel, $prijemce_id){
		/*vyberu zašifrované zprávy*/
		global $con;
		$sql = "SELECT zprava, odesilatel_id, prijemce_id, uzivatelske_jmeno FROM `chat` Inner join uzivatele on uzivatele.id = chat.odesilatel_id WHERE odesilatel_id = '$odesilatel' and prijemce_id = '$prijemce_id' or odesilatel_id = '$prijemce_id' and prijemce_id = '$odesilatel'";
		$query = mysqli_query($con, $sql);
		$vysledek = "";
		if ($query) {
			$row = mysqli_fetch_all($query);
			if ($row) {
				foreach ($row as $key => $value) {
					/*proces dešifrování*/
					/*zvolým šifru, kterou byla zpráva zašifrována a klíč*/
						$cipher = "aes-256-cbc";
						$key_cipher = $_SESSION['post']['klic'];
					/*dekóduje zašifrovaný text pomocí base64*/
						$c = base64_decode($value['0']);
					/*délka šifry*/
						$ivlen = openssl_cipher_iv_length($cipher);
						$iv = substr($c, 0, $ivlen);
						$hmac = substr($c, $ivlen, $sha2len=32);
						$ciphertext_raw = substr($c,$ivlen+$sha2len);
						$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key_cipher, $options=OPENSSL_RAW_DATA, $iv);
						$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);	
						/*vypsání dešifrované zprávy*/
						$vysledek .= "<div class='zprava_v_chatu'><span class='autor_zpravy'>".$value["3"]."</span><br><span class='vlevo_zprava'>".$original_plaintext."</span></div>";
				}
				/*pokud se nepodaří dešifrování zprávy a nebo žádná neexistuje, tak se zobrzí toto*/
			}else{
				$vysledek .= "<span>nic tu neni a nebo jsi napsal spatny klic k desifraci komunikace</span>";
			}
		}else{
			$vysledek .= "<span>nic tu neni a nebo jsi napsal spatny klic k desifraci komunikace</span>";
		}
		return $vysledek;
	}
	function select_chat_historie($uzivatel){
		global $con;
		$id_uzivatele = select_uzivatel_id($uzivatel);
		$sql = "SELECT distinct * FROM `uzivatele` INNER JOIN `chat` on uzivatele.ID = chat.odesilatel_id WHERE EXISTS (SELECT * FROM `chat` WHERE uzivatele.ID = chat.odesilatel_id OR uzivatele.ID = chat.prijemce_id) AND uzivatele.ID != '$id_uzivatele' AND chat.prijemce_id = '$id_uzivatele' OR chat.odesilatel_id = '$id_uzivatele'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		return $row;
	}
	function chat_historie($uzivatel){
		$vysledek = '';
		$row = select_chat_historie($uzivatel);
		$id_uzivatele = select_uzivatel_id($uzivatel);
		foreach ($row as $key => $value) {
			if ($value[6] == $id_uzivatele) {
				$jmeno = select_uzivatel_jmeno($value[7]);
			}elseif ($value[7] == $id_uzivatele) {
				$jmeno = select_uzivatel_jmeno($value[6]);
			}
			$vysledek .= "chat s uživatelem: ".$jmeno."<br>";
			$vysledek .= "<form action='desifrovani.php' method='POST'><input type='submit' name='uzivatel' value='".$jmeno."'><br>";
		}return $vysledek;
	}
	function seznam($uzivatel){
		global $con;
		$sql = "SELECT uzivatelske_jmeno, id FROM uzivatele WHERE uzivatelske_jmeno != '$uzivatel'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		$vysledek = "<div id='seznam'>";
		$zadost = zadost($uzivatel);
		$prijeti_klice = prijeti_klice($uzivatel);
		echo $prijeti_klice[0][3];
		foreach ($row as $key => $value) {
			$vysledek .= "<div class='uzivatele_seznam'>";
			$vysledek .= "<span class='jmena_seznam'>";
			$vysledek .= $value[0]."<br>";
			$vysledek .= "</span>";
			foreach ($zadost as $key => $valuezadost) {
				if ($value[1] == $valuezadost[1]) {
					$vysledek .= "<form action='zadost.php' method='POST' class='form_zadost'><input type='hidden' name='pro_uzivatele' value='".$valuezadost[0]."'><input type='hidden' name='zadost' value='false'><input type='hidden' name='od_uzivatele' value='".$valuezadost[2]."'><input type='hidden' name='uzivatel' value='".$value[0]."'><input type='submit'></form>";
				}
			}
			foreach ($prijeti_klice as $key => $valueprijeti) {
				if ($value[1] == $valueprijeti[3]) {
					$vysledek .= "<form action='desifrovani_klice.php' method='POST'><input type='hidden' name='id' value='".$valueprijeti[0]."'><input type='submit'></form>";
				}
			}
			$vysledek .= "<form action='desifrovani.php' method='POST' class='desifrovani_form'><input type='hidden' name='uzivatel' value='".$value[0]."'><input type='submit' name='jmeno_uzivatel' value='přejít na chat'></form></div>";	
		}
		$vysledek .= "</div>";
		return $vysledek;
	}
	function zadost($uzivatel){
		global $con;
		$moje_id = select_uzivatel_id($uzivatel);
		$sql = "SELECT * FROM `zadost_o_klic` WHERE pro_uzivatele = '$moje_id'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		return $row;
	}
	function insert_zadost($session_uzivatel, $post_uzivatel){
		global $con;
		$id_uzivatele = select_uzivatel_id($post_uzivatel);
		$moje_id = select_uzivatel_id($session_uzivatel);

		$new_ass_klic = openssl_pkey_new(array('private_key_bits' => 2048));

		$ass_klic = openssl_pkey_get_details($new_ass_klic);
		$public_klic = $ass_klic['key'];

		fopen("sifra.txt", 'w+');
		file_put_contents("sifra.txt", $ass_klic['rsa']);

		$sql = "INSERT INTO `zadost_o_klic` (`od_uzivatele`, `pro_uzivatele`, `ass_klic`) VALUES ('$moje_id', '$id_uzivatele', '$public_klic')";
		$query = mysqli_query($con, $sql);
	}
	function prijeti_klice($session_uzivatel){
		global $con;
		$moje_id = select_uzivatel_id($session_uzivatel);
		$sql = "SELECT * FROM `klic` WHERE pro_uzivatele = '$moje_id'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_all($query);
		return $row;
	}
?>