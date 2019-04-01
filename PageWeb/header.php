<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>AOS-TD3-CoffreFort</title>
</head>
<body>
	<div class="header">
		<div class="top-header navbar navbar-default"><!--header-one-->
			<div class="container">
				<?php
					if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
						echo '<div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
								<p>Bienvenue chez Secure Coffre Fort'.$_SESSION['user_name'].'</p><a href="../PageWeb/signout.php" >Se déconnecter </a>
							</div>';
					}
					else 
						echo '<div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
								<p>Architecture Orienté Service (AOS) - Création de micro services <a href="../PageWeb/register.php">Créer un compte </a> - <a href="../PageWeb/signin.php">Se Connecter</a></p>
							</div>';
				?>
				<div class="clearfix"> </div>
			</div>
		</div>