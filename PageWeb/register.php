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
				<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="../PageWeb/index.php" method="post" enctype="application/json">
					<input type="text" class="uemail" id="nom" name="nom" value="Abasy" placeholder="Votre Nom" required="">
					<input type="text" class="uemail" id="prenom" name="prenom" value="Nadjim" placeholder="Votre Prenom" required="">
					<input type="text" class="uemail"  id="email" name="email" value="abasy@nadjim.fr" placeholder="Adresse E-mail" required="">
					<input type="text" class="uemail"  id="adresse" name="adresse" value="3 rue pipoune" placeholder="Adresse postale" required="">
					<input type="text" class="uemail" id="date" name="date" value="15-15-15" placeholder="Date de naissance" required="">
					<input type="text" class="uemail" id="username" name="username" value="nabasy" placeholder="Votre Username" required="">
					<input type="password" id="password" name="password" n class="lock" value="test" placeholder="Mot de Passe">
					<!--<input type="password" id="password_verify" name="password_verify" n class="lock" placeholder="Vérifier votre mot de passe">-->
					<input type="submit" name="register" value="S'inscrire">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
	<br><br><br><br>
<?php
require_once('../PageWeb/footer.php');
?>