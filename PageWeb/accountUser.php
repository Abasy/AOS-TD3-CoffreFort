<?php
	require_once('../PageWeb/header.php');
?>
<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow fadeInUp" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active">My account</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Information <span> utilisateur</span></h3>
			<p>Bienvenue </p>
		</div>
		<div class="widget-shadow">
			<div class="login-body">
				<?php
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
						echo '<input type="text" class="uemail" id="nom" name="nom" value="'.$result->{'nom'}.'" placeholder="Votre Nom" required="">';

						echo '<input type="text" class="uemail" id="prenom" name="prenom" value="'.$result->{'prenom'}.'" placeholder="Votre Prenom" required="">';

						echo '<input type="text" class="uemail"  id="email" name="email" value="'.$result->{'email'}.'" placeholder="Adresse E-mail" required="">';

						echo '<input type="text" class="uemail"  id="adresse" name="adresse" value="'.$result->{'adresse'}.'" placeholder="Adresse postale" required="">';

						echo '<input type="text" class="uemail" id="date" name="date" value="'.$result->{'date'}.'" placeholder="Date de naissance" required="">';

						echo '<input type="text" class="uemail" id="username" name="username" value="'.$result->{'username'}.'" placeholder="Votre Username" required="">';

						echo '<input type="password" id="password" name="password" n class="lock" value="'.$result->{'password'}.'" placeholder="Mot de Passe">';

						curl_close($crl);*/
					?>
					
					<input type="password" id="new_password" name="new_password" n class="lock" placeholder="Nouveau mot de passe">
					<input type="password" id="password_verify" name="password_verify" n class="lock" placeholder="Vérifier votre mot de passe">
					<input type="submit" name="update" value="Valider">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
	<div>
		<?php
			if (isset($_SESSION['error_update'])) {
				echo '<p>'.$_SESSION['error_update'].'</p>';
				unset($_SESSION['error_update']);
			}
		?>
	</div>
	<div>
		<?php
			if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update'])){
				//Vérifier qu'on est authentifié
				if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
					$resultsession = json_decode($_SESSION['connect']);
					echo $resultsession;

					$password = $resultsession->{'password'};

					echo 'Ici j\'ai mon password : '.$password;

					//Vérifier le nouveau mot de passe
					if(strcmp(isset($_POST['new_password']), isset($_POST['password_verify'])) == 0){
						$password = $_POST['new_password'];
					}else{
						$_SESSION['error_update'] = 'Désolé mais la modification à échoué. Un ou plusieurs champs sont erronés';
						header('Location: ../PageWeb/accountUser.php');
					}

					//Récupérer les nouvelles données
					$myRegister = array(
						'nom' => $_POST['nom'],
						'prenom' => $_POST['prenom'],
						'email' => $_POST['email'],
						'adresse' => $_POST['adresse'],
						'date' => $_POST['date'],
						'username' => $_POST['username'],
						'password' => $password
					);
					
					$myJSON = json_encode($myRegister);
					//echo $myJSON;
					unset($_SESSION['connect']);
					unset($_SESSION['username']);

					$connection = array(
						'username' => $_POST['username'],
						'password' => $password
					);

					$myJSONconnect = json_encode($connection);
					$_SESSION['connect'] = $myJSONconnect;
					$_SESSION['username'] = $_POST['username'];

					echo $_SESSION['connect'];

					$crl = curl_init("http://localhost:4321/api/update");
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

					echo '<div> Modification réussite : '.$result.'</div>';
					curl_close($crl);
				}
			}
		?>
	</div>
<br><br><br><br>
<?php
	require_once('../PageWeb/footer.php');
?>