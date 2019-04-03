<?php

	require_once('../PageWeb/header.php');
?>
<br><br><br><br>
<p>Message système </p>

<div>
	<?php
		//if(isset($_POST['login'])){
			//Vérifier si l'utilisateur existe vraiment
			if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
				$crl = curl_init("http://localhost:5000/api/arp");

				$header = array();
				$header[] = 'token_coffre_fort: qsdgqgsdv45<4v6<4db6v4';

				curl_setopt($crl, CURLOPT_HTTPHEADER,$header);
				$rest = curl_exec($crl);
				
				curl_close($crl);
				print_r($rest);
			}else{
				echo 'No authenticate';
			}
		//}

		if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['register'])){
			$myRegister = array(
				'nom' => $_POST['nom'],
				'prenom' => $_POST['prenom'],
				'email' => $_POST['email'],
				'adresse' => $_POST['adresse'],
				'date' => $_POST['date'],
				'username' => $_POST['username'],
				'password' => $_POST['password']
			);

			$myJSON = json_encode($myRegister);
			//echo $myJSON;

			$crl = curl_init("http://localhost:4321/api/add");
			curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($crl, CURLINFO_HEADER_OUT, true);
			curl_setopt($crl, CURLOPT_POST, true);
			curl_setopt($crl, CURLOPT_POSTFIELDS, $myJSON);
			curl_setopt($crl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Body:'.$myJSON,
				'Content-Lenght:'.strlen($myJSON))
			);
			$result = curl_exec($crl);
			curl_close($crl);
		}
	?>
</div>


<br><br><br><br>
<?php
	require_once('../PageWeb/footer.php');
?>