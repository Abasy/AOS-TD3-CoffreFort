<?php
	require_once('../PageWeb/header.php');
?>
<br><br><br><br>

<div>
	<?php
		//if(($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['login'])){
			//Vérifier si l'utilisateur existe vraiment
			if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
				//Afficher la ressource ici
				echo '<div> Ressources disponible : ';
				$crl = curl_init("http://localhost:5000/api/arp");

				$header = array();
				$header[] = 'token_coffre_fort: '.$_SESSION['userid'];
				
				curl_setopt($crl, CURLOPT_HTTPHEADER,$header);
				$result = curl_exec($crl);
				
				curl_close($crl);
				echo '</div>';
				//print_r($rest);
			}else{
				echo '<div><p>Not authenticate ? You will don\'t get the ressources ! </p></div>';
			}

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

			echo '<div> Inscription : '.$result.'</div>';
			curl_close($crl);
		}
	?>
</div>


<br><br><br><br>
<?php
	require_once('../PageWeb/footer.php');
?>