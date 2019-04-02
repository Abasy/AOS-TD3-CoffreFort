<?php

	if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
		$crl = curl_init("http://localhost:5000/api/arp");

		$header = array();
		$header[] = 'token_coffre_fort: qsdgqgsdv45<4v6<4db6v4';

		curl_setopt($crl, CURLOPT_HTTPHEADER,$header);
		$rest = curl_exec($crl);
		
		curl_close($crl);
		print_r($rest);
	}else{
		echo 'No token to display';
	}

	require_once('../PageWeb/header.php');
?>
<br><br><br><br>
<p>Decrire le projet ici </p>


<br><br><br><br>
<?php
	require_once('../PageWeb/footer.php');
?>