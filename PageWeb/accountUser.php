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
				<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="../PageWeb/accountUser.php" method="post" enctype="application/json">

					<?php

						echo '<input type="text" class="uemail" id="nom" name="nom" value="Abasy" placeholder="Votre Nom" required="">';

						echo '<input type="text" class="uemail" id="prenom" name="prenom" value="Nadjim" placeholder="Votre Prenom" required="">';

						echo '<input type="text" class="uemail"  id="email" name="email" value="abasy@nadjim.fr" placeholder="Adresse E-mail" required="">';

						echo '<input type="text" class="uemail"  id="adresse" name="adresse" value="3 rue pipoune" placeholder="Adresse postale" required="">';

						echo '<input type="text" class="uemail" id="date" name="date" value="15-15-15" placeholder="Date de naissance" required="">';

						echo '<input type="text" class="uemail" id="username" name="username" value="nabasy" placeholder="Votre Username" required="">';

						//echo '<input type="password" id="password" name="password" n class="lock" value="test" placeholder="Mot de Passe">';

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
		/*
			if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update'])){
				//Vérifier qu'on est authentifié
				if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
					$password = "";
					//Vérifier le nouveau mot de passe
					if(strcmp(isset($_POST['new_password']), isset($_POST['password_verify'])) == 0){
						$password = $_POST['new_password'];
					}elseif((isset($_POST['new_password']) == "") || (isset($_POST['password_verify'])) == "")){
						$password = 'password'; //On récupère le password déjà existant
					}else{
						$_SESSION['error_update'] = 'Désolé mais la modification à échoué. Un ou plusieurs champs sont erronés';
						header('Location: ../PageWeb/accountUser.php');
					}

					//Récupérer les nouveaux données
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

					echo '<div> Modification réussie : '.$result.'</div>';
					curl_close($crl);
				}
			}
			*/
		?>
	</div>
<br><br><br><br>
<?php
	require_once('../PageWeb/footer.php');
?>