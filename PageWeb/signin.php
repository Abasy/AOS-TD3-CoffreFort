<?php
	require_once('../PageWeb/header.php');
?>
<div class="container-fluid text-center">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Connectez<span> Vous</span></h3>
			<?php
			if (isset($_SESSION['error_authentication'])) {
				echo '<div class="alert alert-danger" ><strong>Remarque: </strong>'.$_SESSION['error_authentication'].'</div>';
				unset($_SESSION['error_authentication']);
			}
		?>
		</div>
		<div class="widget-shadow">
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<form action="../PageWeb/signin.php" method="post">
					<div class="form-group">
		                <label for="nom"></label>
						<input type="text" class="form-control" name="username" value="" placeholder="Username" required="">
					</div>
					<div class="form-group">
		                <label for="nom"></label>
						<input type="password" class="form-control" name="user_password" value="" placeholder="Mot de passe">
					</div>
					<div class="form-group">
		                <label for="nom"></label>
						<button type="submit" class="btn btn-success" name="login" id="Ajouter">Se connecter</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div>
		<?php
			if(isset($_POST['login'])){
				$connect = array(
					'username' => $_POST['username'],
					'password' => $_POST['user_password']
				);
				$myJSON = json_encode($connect);

				$crl = curl_init("http://localhost:4321/api/auth");
				curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($crl, CURLINFO_HEADER_OUT, true);
				curl_setopt($crl, CURLOPT_POST, true);
				curl_setopt($crl, CURLOPT_POSTFIELDS, $myJSON);
				curl_setopt($crl, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Body:'.$myJSON,
					'Content-Lenght:'.strlen($myJSON))
				);

				echo '<br><br>';
				$result = curl_exec($crl);
				curl_close($crl);

				if(strcmp($result, 'Failed to connect') <> 0){ //Si c'est ok, utilisateur existe. On crée une session pour lui
					echo "Résultat donne ".$result;
					unset($_SESSION['userid']);
					unset($_SESSION['username']);
					unset($_SESSION['connect']);
					$_SESSION['userid'] = $result; //Doit récupérer le tokenDealer
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['connect'] = $myJSON;
					header('Location: ../PageWeb/index.php');
				}else{
					$_SESSION['error_authentication'] = 'Sorry but the authentication is failed';
					header('Location: ../PageWeb/signin.php');
				}
			}
		?>
	</div>
<?php
require_once('../PageWeb/footer.php');
?>
