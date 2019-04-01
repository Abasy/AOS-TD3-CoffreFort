<?php
require_once('../PageWeb/header.php');
?>
<br><br><br><br>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="../PageWeb/index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active">Register</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Formulaire d'<span> inscription</span></h3>
			<p>Bienvenue </p>
		</div>
		<div class="widget-shadow">
			<div class="login-body">
				<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="../PageWeb/register.php" method="post" enctype="multipart/form-data">
					<input type="text" class="uemail" id="firstname" name="firstname" placeholder="Votre Nom" required="">
					<input type="text" class="uemail" id="lastname" name="lastname" placeholder="Votre Prenom" required="">
					<input type="text" class="uemail"  id="email" name="email" placeholder="Adresse E-mail" required="">
					<input type="text" class="uemail"  id="address" name="address" placeholder="Addresse postale" required="">
					<input type="text" class="uemail" id="birthday" name="birthday" placeholder="Date de naissance" required="">
					<input type="text" class="uemail" id="username" name="username" placeholder="Votre Username" required="">
					<input type="password" id="password" name="password" n class="lock" placeholder="Mot de Passe">
					<input type="password" id="password_verify" name="password_verify" n class="lock" placeholder="Vérifier votre mot de passe">
					<input type="submit" name="register" value="S'inscrire">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
	<div>
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$myRegister = new \stdClass();;
				$myRegister->firstname = $_POST['firstname'];
				$myRegister->lastname = $_POST['lastname'];
				$myRegister->email = $_POST['email'];
				$myRegister->address = $_POST['address'];
				$myRegister->birthday = $_POST['birthday'];
				$myRegister->username = $_POST['username'];
				$myRegister->password = $_POST['password'];
				//$myRegister->password_verify = $_POST['password_verify'];

				$myJSON = json_encode($myRegister);

				echo $myJSON;

				$crl = curl_init("http://localhost:4321/api/add");
				curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($crl, CURLOPT_POSTFIELDS, $myJSON);
				curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($crl, CURLOPT_HTTPHEADER, $myJSON);
				$result = curl_exec($crl);
			}
		?>
	</div>
	<br><br><br><br>
<?php
require_once('../PageWeb/footer.php');
?>