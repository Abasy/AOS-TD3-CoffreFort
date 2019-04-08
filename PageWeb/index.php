<?php
	require_once('../PageWeb/header.php');
?>
<br><br><br><br>
<div>
	<?php
		if (isset($_SESSION['error_delete'])) {
			echo '<div class="alert alert-danger" ><strong>Remarque: </strong>'.$_SESSION['error_delete'].' : problème lors de la suppression du compte</div>';
			unset($_SESSION['error_delete']);
		}
		if (isset($_SESSION['success_delete'])) {
			echo '<div class="alert alert-success" ><strong>Remarque: </strong>'.$_SESSION['success_delete'].' : Compte supprimé</div>';
			unset($_SESSION['success_delete']);
		}
	?>
</div>

<div>
	<?php
		//Vérifier si l'utilisateur existe vraiment
		if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
			//Afficher la ressource ici
			echo '<div class="alert alert-success" ><strong>Remarque: </strong> Ressources disponible : ';
			$crl = curl_init("http://localhost:5000/api/arp");

			$header = array();
			$header[] = 'token_coffre_fort: '.$_SESSION['userid'];
			
			curl_setopt($crl, CURLOPT_HTTPHEADER,$header);
			$result = curl_exec($crl);
			
			curl_close($crl);
			echo '</div>';
		}else{
			echo '<div><p>Not authenticated : you will don\'t get the ressources yet ! </p></div>';
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