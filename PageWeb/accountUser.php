<?php require_once('../PageWeb/header.php');
?>
<div class="container-fluid text-center">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
		<h3 class="title">Information <span> utilisateur</span></h3>
<?php
	if (isset($_SESSION['error_update'])) {
		echo '<div class="alert alert-danger" ><strong>Remarque: </strong>'.$_SESSION['error_update'].'</div>';
		unset($_SESSION['error_update']);
	}
	if (isset($_SESSION['success_update'])) {
		echo '<div class="alert alert-success" ><strong>Remarque: </strong>'.$_SESSION['success_update'].'</div>';
		unset($_SESSION['success_update']);
	}
?>
	</div>
	<div class="widget-shadow">
		<div class="login-body">
<?php
				/**
				* On récupère les données de l'utilisateur connecté.
				* 
				*/
				$json = json_decode($_SESSION['connect']);
				$password = $json->{'password'};
				$connection = array(
					'username' => $_SESSION['username'],
					'password' => $password
				);

				$myJSON = json_encode($connection);

				$crl = curl_init("http://localhost:4321/api/getUser");
				curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($crl, CURLINFO_HEADER_OUT, true);
				curl_setopt($crl, CURLOPT_POST, true);
				curl_setopt($crl, CURLOPT_POSTFIELDS, $myJSON);
				curl_setopt($crl, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Body:'.$myJSON,
					'Content-Lenght:'.strlen($myJSON))
				);

				$data = curl_exec($crl);
				$result = json_decode($data);

				echo '<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="../PageWeb/accountUser.php" method="post" enctype="application/json">';

				echo '<div class="form-group">
				<label for="nom"></label><input type="text" class="form-control" id="nom" name="nom" value="'.$result->{'nom'}.'" placeholder="Votre Nom" required=""></div>';

				echo '<div class="form-group">
				<label for="prenom"></label><input type="text" class="form-control" id="prenom" name="prenom" value="'.$result->{'prenom'}.'" placeholder="Votre Prenom" required=""></div>';

				echo '<div class="form-group">
				<label for="email"></label><input type="text" class="form-control"  id="email" name="email" value="'.$result->{'email'}.'" placeholder="Adresse E-mail" required=""></div>';

				echo '<div class="form-group">
				<label for="adresse"></label><input type="text" class="form-control"  id="adresse" name="adresse" value="'.$result->{'adresse'}.'" placeholder="Adresse postale" required=""></div>';

				echo '<div class="form-group"><label for="date"></label><input type="text" class="form-control" id="date" name="date" value="'.$result->{'date'}.'" placeholder="Date de naissance" required=""></div>';

				echo '<div class="form-group">
				<label for="username"></label><input type="text" class="form-control" id="username" name="username" value="'.$result->{'username'}.'" placeholder="Votre Username" required=""></div>';

				curl_close($crl);
?>
				<div class="form-group">
	                <label for="new_password"></label>
	                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Nouveau mot de passe">
	            </div>
	            <div class="form-group">
	                <label for="password_verify"></label>
					<input type="password" id="password_verify" name="password_verify" class="form-control" placeholder="Vérifier votre mot de passe">
				</div>
				<div class="form-group">
	                <button type="submit" class="btn btn-success" name="update" id="update">Modifier</button>
	                <button type="submit" class="btn btn-success" name="delete" id="delete">Suppr. compte</button>
	            </div>
			</form>
		</div>
	</div>
</div>
<!--//login-->
<?php
	if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update'])){
		//Vérifier qu'on est authentifié
		if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
			echo $_SESSION['username'];
			//Vérifier le nouveau mot de passe
			if($_POST['new_password'] == $_POST['password_verify']){
				//On récupère les données de la session
				$resultsession = json_decode($_SESSION['connect']);
				if(empty($_POST['new_password']) || empty($_POST['password_verify'])){
					/*
					* Aucun nouveau mot de passe renseigné
					* On garde le même mot de passe pour l'utilisateur
					*/
					if(isset($_SESSION['connect'])){
						$password = $resultsession->{'password'};
						//echo 'Ici j\'ai mon password : '.$password;
					}
				}else{
					$password = $_POST['new_password'];
				}

				$username = $_POST['username'];
				//Récupérer les nouvelles données
				$myRegister = array(
					'nom' => $_POST['nom'],
					'prenom' => $_POST['prenom'],
					'email' => $_POST['email'],
					'adresse' => $_POST['adresse'],
					'date' => $_POST['date'],
					'username' => $username,
					'password' => $password
				);
			
				$myJSON = json_encode($myRegister);

				$crl = curl_init("http://localhost:4321/api/update?username=".$_SESSION['username']);
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

				if($result == 'Update Success'){
					$connection = array(
						'username' => $username,
						'password' => $password
					);

					$myJSONconnect = json_encode($connection);
					unset($_SESSION['connect']);
					unset($_SESSION['username']);
					unset($_SESSION['success_update']);
					$_SESSION['connect'] = $myJSONconnect;
					$_SESSION['username'] = $username;
					$_SESSION['success_update'] = $result;

				}else{
					unset($_SESSION['error_update']);
					$_SESSION['error_update'] = $result;
				}
				echo '<script>
					    	window.location.href = "../PageWeb/accountUser.php"
					    </script>';
			}else{
				unset($_SESSION['error_update']);
				$_SESSION['error_update'] = 'Désolé mais la modification à échoué. Un ou plusieurs champs sont erronés';

				echo '<script>
				    	window.location.href = "../PageWeb/accountUser.php"
				    </script>';
			}
		}
	}
?>
<br><br><br><br>
<?php
	require_once('../PageWeb/footer.php');
?>