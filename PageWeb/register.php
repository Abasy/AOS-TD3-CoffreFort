<?php
require_once('../PageWeb/header.php');
?>
<br><br><br><br>
	<!--register-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Formulaire d'<span> inscription</span></h3>
		</div>
		<div class="widget-shadow">
			<div class="login-body">
				<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="../PageWeb/index.php" method="post" enctype="application/json">
					
		            <div class="form-group">
		                <label for="nom"></label>
						<input type="text" class="form-control" id="nom" name="nom" value="" placeholder="Votre Nom" required="">
					</div>
					<div class="form-group">
		                <label for="prenom"></label>
						<input type="text" class="form-control" id="prenom" name="prenom" value="" placeholder="Votre Prenom" required="">
					</div>
					<div class="form-group">
		                <label for="email"></label>
						<input type="email" class="form-control"  id="email" name="email" value="" placeholder="Adresse E-mail" required="">
					</div>
					<div class="form-group">
		                <label for="adresse"></label>
						<input type="text" class="form-control"  id="adresse" name="adresse" value="" placeholder="Adresse postale" required="">
					</div>
					<div class="form-group">
		                <label for="date"></label>
						<input type="date" class="form-control" id="date" name="date" value="" placeholder="Date de naissance" required="">
					</div>
					<div class="form-group">
		                <label for="username"></label>
						<input type="text" class="form-control" id="username" name="username" value="" placeholder="Votre Username" required="">
					</div>
					<div class="form-group">
		                <label for="password"></label>
						<input type="password" id="password" name="password"  class="form-control" value="" placeholder="Mot de Passe">
					</div>
					<div class="form-group">
		                <button type="submit" class="btn btn-success" name="register" id="Ajouter">S'inscrire</button>
		            </div>
					<!--<input type="password" id="password_verify" name="password_verify" n class="lock" placeholder="Vérifier votre mot de passe">-->
					
				</form>
			</div>
		</div>
	</div>
	<!--//register-->
	<br><br><br><br>
<?php
require_once('../PageWeb/footer.php');
?>